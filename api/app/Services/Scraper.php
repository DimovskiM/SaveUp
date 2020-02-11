<?php

namespace App\Services;

use Goutte\Client;
use App\Contracts\IScraper;
use App\Product;

class Scraper implements IScraper {

    private $client;

    private $firstWebsite = 'http://setec.mk/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function ScrapeWebsites() {
            $scraper = $this->client->request('GET', $this->firstWebsite);

            $scraper->filter('.product')->each(function ($item) {
                // Product::create([
                //     'name' => $item->text(),
                //     'currentPrice' => 0.00
                // ]);

                $itemName = $item->filter('.name')->text();
                $itemPrice = $item->filter('.price-old-new')->text();
                $itemProductPage = $item->filter('.name > a')->attr('href');
                $itemProductImage = $item->filter('.image > a > img')->attr('src');

                if (strpos($itemProductImage, $this->firstWebsite) == false) {
                    $itemProductImage = $this->firstWebsite . $itemProductImage;
                }

                Product::create([
                    'name' => $itemName,
                    'currentPrice' => 0.00,
                    'imageUrl' => $itemProductImage
                ]);
            });
    }
}