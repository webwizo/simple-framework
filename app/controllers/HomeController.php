<?php

namespace App\Controllers;

class HomeController
{
    /**
     * Show the home page.
     */
    public function index()
    {
        $data = [
            'content' => 'index',
            'title' => 'Home'
        ];

        return view('layouts/master', $data);
    }
}
