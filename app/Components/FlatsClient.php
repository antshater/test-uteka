<?php

namespace App\Components;


use GuzzleHttp\Client;


class FlatsClient
{
    const DOMAIN = 'http://www.50.bn.ru';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var FlatsClient
     */
    private static $instance;


    private function __construct()
    {
        $this->client = new Client(['base_uri' => self::DOMAIN]);
    }


    public static function instance(): FlatsClient
    {
        if (! self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return SearchPage
     */
    public function searchPage(SearchForm $form)
    {
        $html = $this->client->get('/sale/' . $form->type() . '/', [
            'query' => $form->queryParams(),
        ])->getBody()->getContents();
        return new SearchPage($html);
    }
}
