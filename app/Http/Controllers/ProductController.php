<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductRepository;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function index()
    {
        $products = DB::select('CALL sp_get_products()');
        return view('product.index')->with('products', $products);
    }


    public function create()
    {
        $categories = DB::select('CALL sp_get_categories()');
        return view('product.create')->with('categories', $categories);
    }

    public function update($id)
    {
        $categories = DB::select('CALL sp_get_categories()');
        $product = DB::select('CALL sp_get_product(?)', [$id]);
        return view('product.update')->with(['categories' => $categories, 'product' => $product[0]]);
    }


    public function store(Request $request)
    {
        return $this->productRepository->store($request);
    }

    public function show($id)
    {
        $categories = DB::select('CALL sp_get_categories()');
        $product = DB::select('CALL sp_get_product(?)', [$id]);
        return view('product.info')->with(['categories' => $categories, 'product' => $product[0]]);
    }

    public function edit(Request $request)
    {
        return $this->productRepository->edit($request);
    }


    public function destroy($id)
    {
        return $this->productRepository->destroy($id);
    }
}
