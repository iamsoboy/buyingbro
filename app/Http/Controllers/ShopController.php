<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Product;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::with('products')->paginate(9);

        $tags = Brand::inRandomOrder()->take(8)->get();

        return view('shop.index', compact('brands', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }


    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if ($slug == "mybux")
        {
            return redirect()->route('shop.myBux', $slug);
        }

        $brands = Brand::where('slug', $slug)->firstorfail();

        $product_brands = $brands->products()->where('status', 1)->paginate(10);

        //dd(currency()->getUserCurrency());

        return view('shop.show', compact ('brands', 'product_brands'));
    }

    public function myBuxShow($slug)
    {
        $brands = Brand::where('slug', $slug)->firstorfail();

        $product = $brands->products()->where('status', 1)->first();

        return view('shop.mybux', compact ('brands', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
