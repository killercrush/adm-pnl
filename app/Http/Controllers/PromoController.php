<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PromoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Раздел Промокоды
     *
     * @return \Illuminate\Http\Response
     */  
    public function index()
    {
        try {
            $promocodes = \App\Wag_promo_codes::all();
        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return view( 'promo', array( 'promocodes' => $promocodes, 'row_num' => 0 ) );
    }

    public function create(Request $request)
    {
        try {
            $promocode = new \App\Wag_promo_codes;
            $promocode->code = strtoupper( substr( base_convert( sha1( uniqid( mt_rand() ) ), 16, 36 ), 0, 24 ) );
            $promocode->summ = $request->input('summ');
            $promocode->save();
            
        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return redirect('/promo')->with('message', 'Промокод сгенерирован');
    }
    public function save(Request $request)
    {
        try {
            $id = $request->input('promocode_id');
            $promocode = \App\Wag_promo_codes::findOrFail( $id );
            $promocode->code = $request->input('code');
            $promocode->summ = $request->input('summ');
            $promocode->save();
        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return redirect('/promo')->with('message', 'Промокод изменен');
    }
    public function delete(Request $request)
    {
        try {
        	$id = $request->input('promocode_id');
        	\App\Wag_promo_codes::findOrFail( $id )->delete();
        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return redirect('/promo')->with('message', 'Промокод удален');
    }    
}
