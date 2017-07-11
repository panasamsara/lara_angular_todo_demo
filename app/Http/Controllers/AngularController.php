<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AngularController extends Controller
{
    /**
     * 显示angular页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.ng-app');
    }

}
