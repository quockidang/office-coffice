<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    //
    protected $adminRepository;
    public function __construct(UserRepositoryInterface $adminRepository) {
        $this->adminRepository = $adminRepository;
    }

    public function index(){
        if(Auth::user()->is_admin == 1){
            $admins = $this->adminRepository->getAll();
            Session::put('success', 'Load danh sách admin thành công');

            return view('backend.admin.index', compact('admins'));
        }
        Session::put('error', 'Account không có quyền');
        return Redirect::to('dashboard');

    }
}
