<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SaleRepository;
use Illuminate\Http\Request;
use DB;

class SaleController extends Controller
{

    protected $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function index()
    {
        $sales = DB::select('CALL sp_get_sales()');
        return view('sale.index')->with(['sales' => $sales]);
    }

    public function create()
    {
        return view('sale.create');
    }

    public function store(Request $request)
    {
        return $this->saleRepository->store($request);
    }

    public function info(Request $request)
    {
        return $this->saleRepository->info($request);
    }
}
