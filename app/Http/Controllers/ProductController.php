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
     * Раздел Товар
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
            $id = $product->id;

            $key = $request->input('key');
            $tickets_count = $request->input('tickets_count');
            $price = $request->input('price');
            $image = $request->input('image');
            
            $product = \App\Adm_products::find($id);
            for( $i = 0; $i < count($key); $i++ ) {
                if ( $key[$i] != '' ) {
                   $game = new \App\Wag_games; 
                   $game->key = $key[$i];
                   $game->tickets_count = $tickets_count[$i];
                   $game->price = $price[$i];
                   $game->image = $image[$i];
                   $product->games()->save($game);
                }                
            }
            
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return redirect('/product')->with('message', 'Товар добавлен');
    }
    public function save(Request $request)
    {
        try {
            $id = $request->input('product_id');
            $product = \App\Adm_products::find( $id );
            $product->name = $request->input('name');
            $product->category_id = $request->input('category_id');
            $product->save();            

            $key = $request->input('key');
            $tickets_count = $request->input('tickets_count');
            $price = $request->input('price');
            $image = $request->input('image');
            $game_id = $request->input('game_id');

            $product = \App\Adm_products::find($id);
            for( $i = 0; $i < count($key); $i++ ) {
                if ( $key[$i] != '' ) {
                    $is_update = isset($game_id[$i]) && $game_id[$i] != '';

                    if ( $is_update ) {
                        $game = $product->games()->find( $game_id[$i] );
                    } else {
                        $game = new \App\Wag_games; 
                    }

                    $game->key = $key[$i];
                    $game->tickets_count = $tickets_count[$i];
                    $game->price = $price[$i];
                    $game->image = $image[$i];

                    if ( $is_update ) {
                        $game->save();
                    } else {
                        $product->games()->save($game);
                    }
                }                
            }
            
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return redirect('/product')->with('message', 'Товар добавлен');
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
    public function show_add()
    {
        $categories = \App\Adm_category::all();
        return view('edit-product', array('is_adding' => true, 'categories' => $categories));
    }
    public function show_edit($id)
    {
        $categories = \App\Adm_category::all();
        $product = \App\Adm_products::find($id);

        return view('edit-product', array( 'is_adding' => false, 'categories' => $categories, 'product' => $product ));
    }
    public function show_add_category()
    {
        return view('edit-category');
    }
    public function create_category(Request $request)
    {
        try {
            $category = new \App\Adm_category;
            $category->name = $request->input('name');
            $category->save();
            
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return redirect('/product')->with('message', 'Категория добавлена');
    }
    
}
