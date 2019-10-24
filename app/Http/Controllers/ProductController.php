<?php

namespace App\Http\Controllers;

use App\Product;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $product = new Product();
        $product->category_idcategory = $request->input('category_idcategory');
        $product->code = $request->input('code');
        $product->price = $request->input('price');
        $product->mark = $request->input('mark');
        $product->model = $request->input('model');

        DB::insert('CALL sp_insert_product (?,?,?,?,?)', $product);

        echo 'inserted successfully';
        //retornar a alguna vista
    }

    public function info($id)
    {
        $product = DB::select('CALL sp_getInfo_Product (?)', [$id]);

        //retornar alguna vista
    }

    public function update(Request $request, $id)
    {
        $product = new Product();
        $product->category_idcategory = $request->input('category_idcategory');
        $product->code = $request->input('code');
        $product->price = $request->input('price');
        $product->mark = $request->input('mark');
        $product->model = $request->input('model');

        DB::insert('CALL sp_update_product (?,?,?,?,?,?)', $product, [$id]);

        echo 'updated successfully';
    }

    public function delete(Product $product)
    {
        $product = DB::delete('CALL sp_delete_Product (?)', [$id]);

        //retornar alguna vista
    }

    public function lista()
    {
        $products = DB::select('CALL sp_getList_Product');
        //retornar vista
    }

}
