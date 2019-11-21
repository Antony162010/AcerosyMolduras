<?php

namespace App\Http\Repositories;

use DB;
use Validator;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{


    public $messages =  [
        'cod-product.required' => 'El campo id-product es necesario.'
    ];

    public function info($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id-product' => 'required',
                'id-warehouse' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('/home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $idProduct = $request->input('id-product');
            $idWarehouse = $request->input('id-warehouse');

            $response = DB::select("CALL sp_get_product_inventory(?,?)", [
                $idProduct,
                $idWarehouse
            ]);

            if ($response) {
                return view('storeHouse.index')->with('products', $response);
            } else {
                return redirect('/');
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }


    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'cod-product' => 'required',
                'category-product' => 'required',
                'price-product' => 'required',
                'brand-product' => 'required',
                'lenght-product' => 'required',
                'hight-product' => 'required',
                'widht-product' => 'required',
                'model-product' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $codProduct = $request->input('cod-product');
            $categoryProduct = $request->input('category-product');
            $priceProduct = $request->input('price-product');
            $brandProduct = $request->input('brand-product');
            $lenghtProduct = $request->input('lenght-product');
            $hightProduct = $request->input('hight-product');
            $widhtProduct = $request->input('widht-product');
            $modelProduct = $request->input('model-product');

            $imageName = null;
            if ($request->hasFile('image-product')) {
                $imageProduct = $request->file('image-product');
                $extension = $imageProduct->getClientOriginalExtension();

                $imageName = time() . '.' . $extension;
            }
            // dd($request);

            $response = DB::select('CALL sp_insert_product(?,?,?,?,?,?,?,?,?)', [
                $codProduct,
                $categoryProduct,
                $priceProduct,
                $brandProduct,
                $lenghtProduct,
                $hightProduct,
                $widhtProduct,
                $modelProduct,
                $imageName
            ]);

            if ($response[0]->response) {
                if ($request->hasFile('image-product')) {
                    $imageProduct->storeAs('', $imageName, 'images');
                }

                return redirect(route('product.index'))->with('successMsg', 'Se registro el producto exitosamente.');
            } else {
                return redirect(route('product.create'))->withInput()->with('errorMsg', 'Error al insertar el producto.'); // 0 o 2, 
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            $response = DB::select('CALL sp_delete_product(?)', [
                $id
            ]);

            if ($response[0]->response) {
                return redirect(route('product.index'))->with('successMsg', 'Se elimino el producto exitosamente.');
            } else {
                return redirect('')->with('errorMsg', 'Error al eliminar el producto.'); // 0 o 2, 
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }

    public function edit($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'cod-product' => 'required',
                'price-product' => 'required',
            ], $this->messages);

            if ($validator->fails()) {
                return redirect(route('product.index'))
                    ->withErrors($validator)
                    ->withInput();
            }

            $id = $request->input('cod-product');
            $price = $request->input('price-product');
            $longitud = $request->input('lenght-product');
            $altura = $request->input('hight-product');
            $ancho = $request->input('widht-product');

            $imageName = null;
            if ($request->hasFile('image-product')) {
                $imageProduct = $request->file('image-product');
                $oldImage = DB::table('product')
                    ->select('url')
                    ->where('code', $id)
                    ->get();
                $extension = $imageProduct->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
            }

            $response = DB::select('CALL sp_update_product(?,?,?,?,?,?)', [
                $id,
                $price,
                $longitud,
                $altura,
                $ancho,
                $imageName
            ]);

            if ($response[0]->response) {
                if ($request->hasFile('image-product')) {
                    if ($oldImage[0]->url != null)
                        Storage::disk('images')->delete($oldImage[0]->url);
                    $imageProduct->storeAs('', $imageName, 'images');
                }

                return redirect(route('product.index'))->with('successMsg', 'Se actualizo el producto exitosamente.');
            } else {
                return redirect(route('product.update', $id))->withInput()->with('errorMsg', 'Error al actualizar el producto.'); // 0 o 2, 
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }
}
