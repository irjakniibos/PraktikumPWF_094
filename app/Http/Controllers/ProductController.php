<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->get();

        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $currentUser = $request->user();
        $rules = [
            'name'     => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price'    => 'required|numeric',
        ];

        if ($currentUser->role === 'admin') {
            $rules['user_id'] = 'required|exists:users,id';
        }

        $validated = $request->validate($rules);
        $ownerId = $currentUser->role === 'admin'
            ? (int) $validated['user_id']
            : $currentUser->id;

        Product::create([
            'name' => $validated['name'],
            'qty' => $validated['quantity'],
            'price' => $validated['price'],
            'user_id' => $ownerId,
        ]);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function create()
    {
        $currentUser = auth()->user();
        $users = $currentUser->role === 'admin'
            ? User::orderBy('name')->get()
            : User::whereKey($currentUser->id)->get();

        return view('product.create', compact('users'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Terapkan ProductPolicy: cek apakah user boleh update produk ini
        Gate::authorize('update', $product);

        $validated = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer',
            'price'    => 'sometimes|numeric',
            'user_id'  => 'sometimes|exists:users,id',
        ]);

        if (array_key_exists('user_id', $validated)) {
            $targetOwner = User::findOrFail($validated['user_id']);
            $currentUser = $request->user();

            // User biasa tidak boleh memindahkan ownership ke admin.
            if ($currentUser->role !== 'admin' && $targetOwner->role === 'admin') {
                abort(403, 'Akses ditolak. User tidak boleh memindahkan data ke admin.');
            }
        }

        $payload = [
            'name' => $validated['name'] ?? $product->name,
            'qty' => $validated['quantity'] ?? $product->qty,
            'price' => $validated['price'] ?? $product->price,
            'user_id' => $validated['user_id'] ?? $product->user_id,
        ];

        $product->update($payload);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        $usersQuery = User::orderBy('name');

        if (auth()->user()->role !== 'admin') {
            $usersQuery->where('role', '!=', 'admin');
        }

        $users = $usersQuery->get();

        return view('product.edit', compact('product', 'users'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Terapkan ProductPolicy: cek apakah user boleh delete produk ini
        // Admin bisa delete produk siapa saja, user biasa hanya produk miliknya
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    /**
     * Export produk - hanya bisa diakses oleh admin (Gate: export-product)
     * Gate::authorize() otomatis melempar HTTP 403 jika ditolak.
     */
    public function export()
    {
        // Cek Gate - hanya admin yang boleh
        Gate::authorize('export-product');

        $products = Product::with('user')->get();

        // Buat konten CSV
        $csvContent = "No,Nama Produk,Jumlah,Harga,Pemilik\n";
        foreach ($products as $index => $product) {
            $csvContent .= ($index + 1) . ',' .
                           '"' . $product->name . '",' .
                           $product->qty . ',' .
                           $product->price . ',' .
                           '"' . ($product->user->name ?? '-') . '"' . "\n";
        }

        $fileName = 'products_' . now()->format('Ymd_His') . '.csv';

        return response($csvContent, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}