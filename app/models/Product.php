<?php

class Product
{

    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function getProducts()
    {
        $this->db->query("SELECT *,
                          products.product_id as productId,
                          users.id as userId
                          FROM products
                          INNER JOIN users
                          on products.user_id = users.id");
        $results = $this->db->resultSet();

        return $results;
    }
}
