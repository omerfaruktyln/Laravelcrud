<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect('product');
    }

    public function show(string $id)
    {
        $product = Product::FindOrFail($id);
        return view('show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::FindOrFail($id);
        return view('update', compact('product'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);
    
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
    
        return redirect('product');
    }

    public function destroy(string $id)
    {
        $product = Product::FindOrFail($id);
        $product->delete();
        return redirect('product');
    }


    public function index()
    {
        if (Auth::check()) {
            $products = Product::all();
            return view('index', compact('products'));
        } 
        else 
        {
            return redirect()->route('login')->with('auth-error', 'Verileri görmek için giriş yapmalısınız.!!!');
        }
    }

}
