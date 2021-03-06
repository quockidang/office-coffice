<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

use function GuzzleHttp\json_decode;

class ProductController extends Controller
{
    protected $successStatus = 200;
    protected $productReposotory;
    protected $categoryRepository;
    public function __construct(ProductRepositoryInterface $productReposotory, CategoryRepositoryInterface $categoryRepository) {
        $this->productReposotory = $productReposotory;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){
        $products = $this->productReposotory->getAll();
        return response()->json($products, $this->successStatus);
    }

    public function GetProductByCategory($id){
        $category = $this->categoryRepository->find($id);
        $products = $category->products;

        return response()->json($products, $this->successStatus);
    }

    public function GetProductById($id){
        return response()->json($this->productReposotory->find($id), $this->successStatus);
    }

    public function jsondecode(Request $request){

        $string = $request->json;
        $array = json_decode($string);
        if(gettype($array) === "array"){
           return  response()->json($array);
        }

        return response()->json('error');
    }
}
