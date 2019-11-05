<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductRepository;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
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
        return view('product.create')->with('categories',$categories);
    }

    
    public function save(Request $request)
    {
        return $this->productRepository->store($request);
    }

    
    public function show(Provider $provider)
    {
        //
    }

    public function edit(Provider $provider)
    {
        //
    }

    
    public function update(Request $request, Provider $provider)
    {
        //
    }

    
    public function destroy(Provider $provider)
    {
        //
    }
}
