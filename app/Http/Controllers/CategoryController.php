<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){
        if(Auth::user()->role_id == 1){
        $categories = $this->categoryRepository->getAll();
        Session::put('success', 'Load danh sách danh mục thành công');
        return view('backend.category.index', compact('categories'));
        }else{
            Session::put('error', 'Account không có quyền');
            return Redirect::to('dashboard');
        }
    }

    public function add(Request $request){
        if(Auth::user()->role_id == 1){
            $input = $request->all();
            $this->categoryRepository->create($input);
            Session::put('success', 'Thêm danh mục thành công');
            return redirect()->route('category.index');
        }
    }

    public function update($id, Request $request){
        $this->categoryRepository->update($id, $request->all());
        Session::put('success', 'Thêm danh mục thành công');
        return redirect()->route('category.index');
    }

    public function delete($id){
        $this->categoryRepository->delete($id);
        Session::put('success', 'Thêm danh mục thành công');
        return redirect()->route('category.index');
    }
}
