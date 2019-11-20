<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderItem;
use function GuzzleHttp\json_encode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function json(){
        $data = OrderItem::all();

        echo json_encode($data);

    }
}
