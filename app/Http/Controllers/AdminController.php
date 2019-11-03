<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        if (array_key_exists('user_session', $_SESSION)) {
            return \redirect()->guest('/home');
        } else {
            return \view('user.login');
        }
    }

    public function home()
    {
        return \view('layout.home');
    }

    public function signin(Request $request)
    {
        return $this->adminRepository->signin($request);
    }

    public function logout()
    {
        return $this->adminRepository->logout();
    }
}
