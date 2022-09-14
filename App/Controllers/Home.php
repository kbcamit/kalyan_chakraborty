<?php

namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    public function __construct()
    {

    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {
        echo "Hello home index";
    }
}
