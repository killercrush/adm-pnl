<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommonController extends Controller
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
    public function save(Request $request)
    {
        try {
            $common = \App\Adm_common::first();
            $common->site_name = $request->input('site_name');
            $common->keywords = $request->input('keywords');
            $common->site_desc = $request->input('site_desc');
            $common->site_down_desc = $request->input('site_down_desc');
            $common->is_site_down = $request->input('is_site_down');
            $common->save();
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return view('common', array('common' => $common));
    }
    public function index()
    {
        try {
            $common = \App\Adm_common::first();
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return view('common', array('common' => $common));
    }    
}
