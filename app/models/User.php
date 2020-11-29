<?php

class User
{

    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    //register user
    function register($data)
    {
        $this->db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');

        //bind values 
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function login($email, $password)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;

        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }




    //find user by email
    function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        //bind value
        $this->db->bind(':email', $email);

        //fatch single data
        $row = $this->db->single();

        //check row
        if ($this->db->rowCount() > 0) {

            return true;
        } else {
            return false;
        }
    }

    function getUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    function profile()
    {
    }
}
