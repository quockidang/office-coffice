<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
class ProductController extends Controller
{
    protected $successStatus = 200;
    protected $productReposotory;

    public function __construct(ProductRepositoryInterface $productReposotory) {
        $this->productReposotory = $productReposotory;
    }

    public function index(){
        $products = $this->productReposotory->getAll();
        return response()->json($products, $this->successStatus);
    }
}
