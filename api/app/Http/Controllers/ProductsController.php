<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index() {
        try {

            $a = Category::all();
        }
        catch (Exception $e){
            $a = $e;
        }
        return response()->json($a);
    }

    //
}
