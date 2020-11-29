<?php

class Products extends Controller
{
    function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->productModel = $this->model('Product');
    }

    function index()
    {
        $products = $this->productModel->getProducts();

        $data = [

            'products' => $products
        ];

        $this->views('products/index', $data);
    }
}
