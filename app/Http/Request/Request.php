<?php


namespace App\Http\Request;



class Request
{
    private $routePath;

    private $postData;


    public function __construct($routePath, $postData)
    {
        $this->routePath = $routePath;
        $this->postData = $postData;
    }

    public function routePath(): string
    {
        return $this->routePath;
    }

    public function post($key)
    {
        $keys = explode('.', $key);
        $data = $this->postData;

        foreach ($keys as $path) {
            $data = $data && isset($data[$path]) ? $data[$path] : null;
        }

        return $data;
    }
}
