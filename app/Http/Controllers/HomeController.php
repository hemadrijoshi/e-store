<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::limit(3)->get();
        return view('index', compact('product'));
    }

    public function Shop()
    {
        $productData = Product::get();
        return view('shop', compact('productData'));   
    }

    public function basket()
    {
        return view('cart');
    }

    public function AddToCart(Request $request, $id)
    {
        $product = Product::where('id',$id)->get()->toArray();
        $basket = session()->get('basket');
        if(!$basket) {
            $basket[$id] = [
            "id" => $product[0]['id'],
            "product_name" => $product[0]['product_name'],
            "no_of_pc" => $request->no_of_pc,
            "price" => $product[0]['price'],
            "product_details" => $product[0]['product_details'],
            "vendor_id" => $product[0]['vendor_id']
            ];
            session()->put('basket',$basket);
            return redirect()->route('basket');  
        }
        if(isset($basket[$id])) {
            $basket[$id]['no_of_pc']++;
            session()->put('basket',$basket);
             return redirect()->route('basket');
        }
        $basket[$id] = [
            "id" => $product[0]['id'],
            "product_name" => $product[0]['product_name'],
            "no_of_pc" => $request->no_of_pc,
            "price" => $product[0]['price'],
            "product_details" => $product[0]['product_details'],
            "vendor_id" => $product[0]['vendor_id']
        ];
        session()->put('basket',$basket);
        return redirect()->route('basket');
    }
}
