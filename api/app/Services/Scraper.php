<?php

namespace App\Services;

use Goutte\Client;
use App\Contracts\IScraper;
use App\Price;
use App\Product;
use Exception;

class Scraper implements IScraper {

    private $client;

    private $anhochWebsite = 'http://www.anhoch.com';
    private $anhochWebsiteSecure = 'https://www.anhoch.com/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function ScrapeWebsites() {

        $scraper = $this->client->request('GET', $this->anhochWebsite);
        $scraper->filter('a[href]')->each(function ($url) {
            $pageUrl = $url->attr('href');
            print $pageUrl . '<br\>';
            if (strpos($pageUrl, $this->anhochWebsiteSecure) !== false) {
                error_log('hi');
                $this->scrapeAnhoch($pageUrl);
            }
        });
           
    }

    private function scrapeSetec($url) {
        $scraper = $this->client->request('GET', $url);

        $scraper->filter('.product')->each(function ($item) {
            try {
                $itemName = $item->filter('.name')->text();
                $itemPrice = $item->filter('.price-old-new')->text();
                $itemProductPage = $item->filter('.name > a')->attr('href');
                $itemProductImage = $item->filter('.image > a > img')->attr('src');
    
                if (strpos($itemProductImage, $this->firstWebsite) == false) {
                    $itemProductImage = $this->firstWebsite . $itemProductImage;
                }
                
                Product::create([
                    'name' => $itemName,
                    'currentPrice' => floatval($itemPrice),
                    'imageUrl' => $itemProductImage,
                    'productPage' => $itemProductPage
                ]);
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
           
        });
    }

    private function scrapeAnhoch($url) {
        $scraper = $this->client->request('GET', $url); 
        error_log('hello');
        $scraper->filter('li.span3')->each(function ($item) {
            try {
                    $itemName = $item->filter('.product-name')->attr('title');
                    $itemPrice = $item->filter('.product-price.clearfix > .pull-left > div > strong > .nm')->text();
                    $itemProductImage = $item->filter('img.products-img.pad-top-large.lazy-load-image-new')->attr('src');
                    $itemProductPage = $item->filter('.product-figure > a')->attr('href');
                    
                    $itemPriceAsFloat = floatval(str_replace(',', '', $itemPrice));
                    $product = Product::where('name', '=', $itemName)->first();

                    if ($product === null) {
                        Product::create([
                            'name' => $itemName,
                            'currentPrice' => $itemPriceAsFloat,
                            'imageUrl' => $itemProductImage,
                            'productPage' => $itemProductPage
                            ]);
                    }
                    else {
                        $product->prices()->create([
                            'price' => $product->currentPrice,
                            'date' => $product->updated_at
                        ]);
                        $product->update(['currentPrice' => floatval($itemPrice)]);
                    }
                    
                } catch (Exception $e) {
                    error_log($e->getMessage()); 
                }
        });
    }
}