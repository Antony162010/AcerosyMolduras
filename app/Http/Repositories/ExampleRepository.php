<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class ExampleRepository
{
    public $messages = [
        'cod-country.required' => 'El campo Código de país de libro es requerido',
        'name-country.required' => 'El campo Nombre de país es requerido',
        'iso-country.required' => 'El campo Iso del país es requerido',
        'cod-country.size' => 'El campo Código de país solo puede tener 3 caracteres',
        'iso-country.size' => 'El campo Iso del país solo puede tener 2 caracteres',
    ];

    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code-book' => 'required',
                'name-book' => 'required',
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('books/create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $codBook = $request->input('code-book');
            $titleBook = $request->input('name-book');

            $response = DB::table('libro')->insert([
                'CODLIBRO' => $codBook,
                'DESCRIPCION' => $titleBook,
            ]);

            if ($response) {
                return redirect('books');
            } else {
                return back()->withInput();
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }

    public function update($request, $id)
    {
        try {
            

            $validator = Validator::make($request->all(), [
                'code-book' => 'required',
                'name-book' => 'required',
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('books/' . $id . '/edit')
                    ->withErrors($validator)
                    ->withInput();
            }

            $codBook = $request->input('code-book');
            $titleBook = $request->input('name-book');

            $response = DB::table('libro')
                ->where('CODLIBRO', $id)
                ->update([
                    'CODLIBRO' => $codBook,
                    'DESCRIPCION' => $titleBook
                ]);

            if ($response) {
                return redirect('books');
            } else {
                return back()->withInput();
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }
}
