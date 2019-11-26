<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Product;
use App\Category;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productReposotory;

    public function __construct(ProductRepositoryInterface $productReposotory)
    {
        $this->productReposotory = $productReposotory;
    }

    public function index()
    {

        //$products = $this->productReposotory->getAll()->simplePaginate(5);
        //$products = $products
        $products = Product::simplePaginate(5);
        $categories = Category::all();
        Session::put('success', 'Load danh sách sản phẩm thành công');
        return view('backend.product.index', compact('products'));
    }

    public function add(Request $req)
    {


        $productAdd = new Product;
        $productAdd->category_id = $req->category_id;
        $productAdd->name = $req->name;
        $productAdd->price = $req->price;
        $productAdd->description = $req->description;
        $productAdd->content = $req->content;
        $productAdd->price = $req->price;
        $productAdd->price_L = $req->price_L;
        $productAdd->promotion_price =  $req->promotion_price;
        $get_image = $req->file('image');
        $name_image = current(explode('.', $get_image->getClientOriginalName()));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move('source/images', $new_image);
        $productAdd->image = $new_image;
        $productAdd->save();
        Session::put('success', 'Add sản phẩm thành công');
        return Redirect::to('product/index');
    }
    public function delete($id)
    {

        $this->productReposotory->delete($id);
        Session::put('success', 'Delete sản phẩm thành công');
        return Redirect::to('product/index');
    }
    public function update(Request $req, $id)
    {

        $productAdd = Product::find($id);
        $productAdd->category_id = $req->category_id;
        $productAdd->name = $req->name;
        $productAdd->price = $req->price;
        $productAdd->description = $req->description;
        $productAdd->content = $req->content;
        $productAdd->price = $req->price;
        $productAdd->price_L = $req->price_L;
        $productAdd->promotion_price =  $req->promotion_price;

        $get_image = $req->file('image');
        if ($get_image) {
            $name_image = current(explode('.', $get_image->getClientOriginalName()));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('source/images', $new_image);
            $productAdd->image = $new_image;
            $productAdd->save();
            Session::put('success', 'Delete sản phẩm thành công');
            return Redirect::to('product/index');
        } else {
            $productAdd->save();
            Session::put('success', 'Delete sản phẩm thành công');
            return Redirect::to('product/index');
        }
    }

    public function viewupdate($id)
    {
        $item = Product::find($id);
        return view('backend.product.update', compact('item'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();


            foreach ($products as $key => $item) {
                $output .= '
                            <tr>
                                <th class="align-middle" scope="row">' . $item->id . '</th>
                                <td class="align-middle">' . $item->name . '</th>
                                <td class="align-middle">' . $item->category->name . '</td>

                                <td class="align-middle">
                                    <img src="source/images/' . $item->image . '" width="60" height="60">
                                </td>
                                <td class="align-middle">' . number_format($item->price) . ' VNĐ' . '</td>
                                <td class="align-middle">

                                    <a title="update product" href="' . route('product.viewupdate', ['id' => $item->id]) . '"
                                    class="btn btn-warning btn-circle">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <!-- Delete category -->
                                    <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteProduct' . $item->id . '"
                                        title="delete category">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteProduct' . $item->id . '" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có chắn chắn muốn xóa sản phẩm này?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="' . route('product.delete', ['id' => $item->id]) . '"
                                                class="btn btn-primary">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end delete category -->
                        </td>
                        </tr>
                            ';
            }
            return Response($output);
        }
    }

    public function getAllByCategory($id){
        $products = Product::where('category_id', $id)->get();

        return view();


    }
}
