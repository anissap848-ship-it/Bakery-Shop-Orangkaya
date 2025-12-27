<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display cart page
     */
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $cartItems->sum('subtotal');

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Sorry, insufficient stock!');
        }

        $cartItem = Cart::where('product_id', $product->id)
            ->where(function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })
            ->first();

        if ($cartItem) {
            // Update quantity if already exists
            $newQuantity = $cartItem->quantity + $request->quantity;

            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Sorry, insufficient stock!');
            }

            $cartItem->update([
                'quantity' => $newQuantity
            ]);
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'session_id' => !Auth::check() ? session()->getId() : null,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    /**
     * Update cart quantity
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = $cart->product;

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Sorry, insufficient stock!');
        }

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart
     */
    public function remove(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Item removed from cart!');
    }

    /**
     * Clear all cart
     */
    public function clear()
    {
        $cartItems = $this->getCartItems();
        foreach ($cartItems as $item) {
            $item->delete();
        }

        return back()->with('success', 'Cart cleared!');
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout!');
        }

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum('subtotal');
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        return view('cart.checkout', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    /**
     * Process checkout
     */
    public function processCheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout!');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'payment_method' => 'required|in:bank_transfer,cod,credit_card',
            'notes' => 'nullable|string',
        ]);

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        try {
            DB::beginTransaction();

            // Calculate total
            $subtotal = $cartItems->sum('subtotal');
            $tax = $subtotal * 0.1;
            $total = $subtotal + $tax;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total' => $total,
                'status' => 'pending',
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items & update stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                ]);

                // Update product stock
                $product = Product::find($item->product_id);
                $product->decrement('stock', $item->quantity);

                // Delete cart item
                $item->delete();
            }

            DB::commit();

            return redirect()->route('cart.success', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    /**
     * Order success page
     */
    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('cart.success', compact('order'));
    }

    /**
     * Get cart items count (for navbar badge)
     */
    public function count()
    {
        $count = $this->getCartItems()->sum('quantity');
        return response()->json(['count' => $count]);
    }

    /**
     * Get cart items (for authenticated or guest users)
     */
    private function getCartItems()
    {
        if (Auth::check()) {
            return Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            return Cart::with('product')
                ->where('session_id', session()->getId())
                ->get();
        }
    }
}
