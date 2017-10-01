<?php

namespace App\Http;


use App\Components\FlatsClient;
use App\Components\SearchForm;


class SearchController extends Controller
{
    public function index()
    {
        $form = new SearchForm($this->request->post('search'));
        $page = FlatsClient::instance()->searchPage($form);
        $this->view('form', [
            'realtyTypes' => $page->realtyTypes(),
            'rooms'       => $page->rooms(),
            'results'     => $page->results(),
            'form'        => $form,
        ]);
    }
}
