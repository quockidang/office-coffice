<?php

namespace App\Repositories\Product;

use App\Product;
use App\Repositories\EloquentRepository;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Product::class;
    }

    public function getAllProductByCategory($id){
        return App\Product::where('category_id', $id)->get();
    }
}
