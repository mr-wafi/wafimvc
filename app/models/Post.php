<?php

class Post
{
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function getPosts()
    {
        $this->db->query("SELECT *,
                          posts.id as postId,
                          users.id as userId,
                          posts.created_at as postCreated,
                          users.created_at as userCreated
                          FROM posts
                          INNER JOIN users
                          on posts.user_id = users.id
                          ORDER BY posts.created_at DESC
                          ");

        $results = $this->db->resultSet();

        return $results;
    }

    function addPost($data)
    {
        $this->db->query('INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)');

        //bind values 
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        //execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function updatePost($data)
    {
        $this->db->query('UPDATE posts set title = :title, body = :body WHERE id = :id');
        //bind values 
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        //execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function getPostById($id)
    {
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}
