<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Session;
use App\User;
class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index(){
        //$users = $this->userRepository->getAll();
        $users = User::where('is_admin', 0)->get();
        Session::put('success', 'Load danh sách khách hàng thành công');
        return view('backend.customer.index', compact('users'));
    }

}
