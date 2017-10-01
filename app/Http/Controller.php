<?php

namespace App\Http;

use App\Http\Request\Request;


class Controller
{
    /**
     * @var Request
     */
    protected $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function view(string $viewName, array $params = [])
    {
        foreach ($params as $key => $value) {
            ${$key} = $value;
        }

        require realpath(__DIR__ . "/../views") . "/{$viewName}.php" ;
    }

}
