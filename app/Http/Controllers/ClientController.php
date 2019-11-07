<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ClientRepository;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository = $clientRepository;
    }
  
    public function index()
    {
        $clients = DB::select('CALL sp_get_clients()');
        return view('cient.index')->with('clients', $clients);
    }


    public function create()
    {
        return view('client.create');
    }

    
    public function store(Request $request)
    {
        return $this->clientRepository->store($request);
    }
    


    public function edit(Request $request)
    {
        return $this->clientRepository->edit($request);
    }


    public function destroy($id)
    {
        return $this->clientRepository->destroy($id);
    }
}
