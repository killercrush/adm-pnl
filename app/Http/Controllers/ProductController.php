<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Раздел общее
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $product = new \App\Adm_products;
            $product->name = $request->input('name');
            $product->category_id = $request->input('category_id');
            $product->save();
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return $this->index();
    }
    public function index()
    {
        try {
            $products = \App\Adm_products::all();
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return view('product', array('products' => $products));
    }
    public function show_edit()
    {
        return view('edit-product', array('is_adding' => true));
    }     
}
