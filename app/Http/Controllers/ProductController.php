<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
//        dd($products);
        return view('products.index', ['products' => $products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'nullable'
        ]);

//        Product::create($data);

        $product = new Product;

        if (isset($data)) {
            $product->name = $data['name'];
            $product->qty = $data['qty'];
            $product->price = $data['price'];
            $product->description = $data['description'];

            $product->save();
        }

        return redirect(route('product.index'));
    }
}
