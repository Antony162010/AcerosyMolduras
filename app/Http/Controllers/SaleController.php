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
        $departments = DB::select('CALL sp_get_departments()');
        return view('sale.create')->with([
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        return $this->saleRepository->store($request);
    }

    public function info(Request $request)
    {
        return $this->saleRepository->info($request);
    }

    public function getProducts(Request $request)
    {
        return $this->saleRepository->getProducts($request);
    }

    public function getProvinces(Request $request)
    {
        return $this->saleRepository->getProvinces($request);
    }

    public function getDistricts(Request $request)
    {
        return $this->saleRepository->getDistricts($request);
    }
}
