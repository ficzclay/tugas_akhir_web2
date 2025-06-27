<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => '',
            'content' => ''
        ];

        return view('home', $data);
    }
}