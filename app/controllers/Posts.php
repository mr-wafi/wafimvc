<?php

class Posts extends Controller
{
    function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    function index()
    {
        //get posts

        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];
        $this->views('posts/index', $data);
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //this function just cleaning string errors

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => trim($_SESSION['user_id']),
                'title_err' => '',
                'body_err' => ''
            ];
            //validating incoming data from form
            if (empty($data['title'])) {
                $data['title_err'] = "please enter the title";
            }
            if (empty($data['body'])) {
                $data['body_err'] = "please enter body text";
            }

            //make sure no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //mean nothig wrong validated

                if ($this->postModel->addPost($data)) {
                    flash('post_Added', "post added successfully");
                    redirect('posts');
                } else {
                    die("something went wrong");
                }
            } else {
                //load views with errors
                $this->views('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->views('posts/add');
        }
    }

    function edit($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //this function just cleaning string errors

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => trim($_SESSION['user_id']),
                'title_err' => '',
                'body_err' => ''
            ];
            //validating incoming data from form
            if (empty($data['title'])) {
                $data['title_err'] = "please enter the title";
            }
            if (empty($data['body'])) {
                $data['body_err'] = "please enter body text";
            }

            //make sure no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //mean nothig wrong validated

                if ($this->postModel->updatePost($data)) {
                    flash('post_Added', "post updated successfully");
                    redirect('posts');
                } else {
                    die("something went wrong");
                }
            } else {
                //load views with errors
                $this->views('posts/edit', $data);
            }
        } else {

            //check existing post from model
            $post = $this->postModel->getPostById($id);

            //check the owner of the post

            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }


            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];
            $this->views('posts/edit', $data);
        }
    }

    function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user,
        ];
        $this->views('posts/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing post from model
            $post = $this->postModel->getPostById($id);

            // Check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            if ($this->postModel->deletePost($id)) {
                flash('post_Added', 'Post Removed successfully');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('posts');
        }
    }
}
