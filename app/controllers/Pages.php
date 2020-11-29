<?php

class Pages extends Controller
{

    function __construct()
    {
    }

    function index()
    {
        if (isLoggedIn()) {

            redirect('posts');
        }
        $data = [
            'title' => 'Share Posts',
            'description' => 'simple social network built in wafimvc php framwork'
        ];

        $this->views('pages/index', $data);
    }

    function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'simple social network built in wafimvc php framwork'
        ];
        $this->views('pages/about', $data);
    }
}
