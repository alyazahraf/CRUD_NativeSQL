<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    // CREATE DATA
    public function store(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $quantity = $request->quantity;
        $description = $request->description;

        DB::insert('INSERT INTO products (name, price, quantity, description) VALUES (?, ?, ?, ?)', [
            $name ?? null,
            $price ?? null,
            $quantity ?? null,
            $description ?? null
        ]);

        return "Product added successfully. <a href='" . route('products.index') . "'>View Products</a>";
    }

    // READ DATA
    public function index()
    {
        $products = DB::select('SELECT * FROM products');

        return view('products.index', ['products' => $products]);
    }

    // UPDATE DATA
    public function edit($id)
    {
        $product = DB::select('SELECT * FROM products WHERE id = ?', [$id])[0] ?? null;

        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $description = $request->input('description');

        DB::update('UPDATE products SET name = ?, price = ?, quantity = ?, description = ? WHERE id = ?', [$name, $price, $quantity, $description, $id]);

        return "Product updated successfully. <a href='" . route('products.index') . "'>View Products</a>";
    }

    // DELETE DATA
    public function delete($id)
    {
        DB::delete('DELETE FROM products WHERE id = ?', [$id]);

        return "Product deleted successfully. <a href='" . route('products.index') . "'>View Products</a>";
    }
}
