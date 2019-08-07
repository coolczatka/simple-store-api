<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if($request->has('cat')) {
            $result = Product::whereHas('categories', function ($q) use ($request) {
                $q->where('name', '=', $request->query('cat'));
            })->where('name', 'like', '%'.$request->query('search').'%')->simplePaginate(5);
        }
        else{
            if($request->has('search'))
                $result = Product::where('name', 'like','%'.$request->query('search').'%')->simplePaginate(5);
            else
                $result = Product::paginate(5);
        }
        return $result;
    }


    public function create(Request $request)
    {
        $product = new Product();
        $product->url = $request->url;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        return Response(json_encode(['created'=>'true']),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->url = $request->url ?? $product->url;
        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->description = $request->description ?? $product->description;
        $product->save();
        return Response(json_encode(['updated'=>'true']),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $product->delete();
        return Response(['deleted'=>'true'],200);
    }
}
