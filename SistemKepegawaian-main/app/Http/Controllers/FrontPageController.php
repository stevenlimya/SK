<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {   
        $Loker = Loker::all();
        
        return view("pages.FrontPage.index", [
            "loker" => $Loker        
        ]);
    }
    public function noaccess()
    {   
        
        return view("pages.FrontPage.noaccess", [
        ]);
    }
}
