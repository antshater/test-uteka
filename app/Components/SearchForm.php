<?php


namespace App\Components;


class SearchForm
{
    /**
     * @var array
     */
    private $params;


    public function __construct($params = [])
    {
        $this->params = $params;
    }


    private function escapeNumber($number)
    {
        return preg_replace('/\D/', '', $number);
    }


    public function type()
    {
        return preg_replace('/[^A-Za-z\/_]/', '', $this->params['type'] ?? 'city/flats');
    }


    public function rooms()
    {
        return array_map(function ($room) {
            return $this->escapeNumber($room);
        }, $this->params['rooms'] ?? []);
    }


    public function price($key = null)
    {
        $price = [
            'from' => $this->escapeNumber($this->params['price']['from'] ?? ''),
            'to'   => $this->escapeNumber($this->params['price']['to'] ?? ''),
        ];

        return $key ? $price[$key] : $price;
    }


    public function onlyPhoto()
    {
        return isset($this->params['only_photo']) ? (bool)$this->params['only_photo'] : null;
    }


    public function queryParams()
    {
        return [
            'price'      => $this->price(),
            'rooms'      => $this->rooms(),
            'only_photo' => $this->onlyPhoto(),
        ];
    }
}
