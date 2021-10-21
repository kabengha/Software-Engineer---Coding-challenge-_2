<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository {

    protected $dataArray = [
        'name',
        'description',
        'price',
        'category_id',
        'image'
    ];

    public function allProducts($pagination=null) {

        $query = Product::query();

        $isSortedbyCategory = false;

        if (request()->has('sort') && request()->sort == 'name')
        {
            $query->orderBy('name', 'asc');
        }

        if (request()->has('sort') && request()->sort == 'price')
        {
            $query->orderBy('price', 'asc');
        }

        if (request()->has('sort') && request()->sort == 'category')
        {
            $query->orderBy('category_id', 'asc');
        }
        
        try {

            if(empty($pagination)) {
                $data = $query->with('category')->get();
            }else{
                $data = Product::with('category')->paginate($pagination);
            }

            return $data;

        } catch (ValidatorException $e) {
            throw new Exception('somthing wrong');
        }

    }
    
    public function storeProduct($request) {
        
        try {
            $data = $request->only($this->dataArray);
            $product = Product::create($data);
            return $product;
        } catch (ValidatorException $e) {
            throw new Exception('somthing wrong check your data and try again :)');
        }
    }
    
   
    public function find($idProduct) {

        $product = Product::findOrFail($idProduct);

        return $product;
    }

}