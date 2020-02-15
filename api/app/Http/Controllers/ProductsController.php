<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Contracts\IScraper;
use App\Product;

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
        return response()->json(Product::with('prices')->get());
    }

    //
}
