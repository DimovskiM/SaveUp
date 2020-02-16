<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Contracts\IScraper;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $scraper;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IScraper $scraper)
    {
        $this->scraper = $scraper;
    }

    public function index() {
        return response()->json(Product::with('prices')->orderBy('updated_at', 'DESC')->get());
    }

    public function getById($id) {
        return response()->json(Product::find($id)->load('prices'));
    }

    //
}
