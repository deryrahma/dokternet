<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display administrator main page/dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'pages.admin.index' );
    }
}
