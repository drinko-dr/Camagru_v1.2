<?php

class Gallery extends Controller
{
    public function index()
    {
        $this->loadModel('PostModel');
        $this->loadModel('CommentModel');

        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $maximg = 9;
        $debut = ($page - 1) * $maximg;

        $data = $this->PostModel->get_paginated_posts($maximg, $debut);
        $data['page'] = $page;
        $data['max_pages'] = count($data['posts']) / 9;

        $this->loadView('templates/header');
        $this->loadView('Gallery/index', $data);
        $this->loadView('templates/footer');
    }
}
