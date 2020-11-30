<?php

class Admin extends Controller
{
    public function index()
    {
        $data['current'] = "home";
        if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
            include '404.php';
        } else {
            $this->loadView('templates/header');
            $this->loadView('admin/navbar', $data);
            $this->loadView('Admin/index');
            $this->loadView('templates/footer');
        }
    }

    public function filters()
    {
        $this->loadModel('FilterModel');

        $data = array(
            'current' => "filters",
        );
        if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
            include '404.php';
        } else {
            if (isset($_POST['filtername']) && isset($_POST['image'])) {
                $this->loadModel('FilterModel');
                $data = array(
                    'error' => '',
                    'current' => 'filters',
                    'filtername' => trim(htmlspecialchars($_POST['filtername'])),
                );
                $type = mime_content_type($_POST['image']);
                if ($type == "image/png" || $type == "image/jpeg") {
                    if ($this->FilterModel->filter_exists($data['filtername'], $_POST['image']) == true) {
                        $data['error'] .= "A filter with that name already exists";
                    } else {
                        $this->FilterModel->create_filter($_POST['image'], $data['filtername']);
                    }
                }
            }
            $data['filters'] = $this->FilterModel->get_filters();

            $this->loadView('templates/header');
            $this->loadView('Admin/navbar', $data);
            $this->loadView('Admin/filters', $data);
            $this->loadView('templates/footer');
        }
    }

    public function delete_filter()
    {
        $this->loadModel('FilterModel');
        if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
            include '404.php';
        } else {
            if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
                $this->FilterModel->delete_filter($_POST['id']);
                header('Location: /index.php/Admin/Filters');
            } else {
                include '404.php';
            }
        }
    }

    public function members()
    {
        if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
            include '404.php';
        } else {
            $this->loadModel('UserModel');
            $this->loadModel('PostModel');
            $this->loadModel('CommentModel');
            $this->loadModel('LikeModel');

            $data = array(
                'current' => "members",
                'users' => null,
            );
            $i = 0;
            $users = $this->UserModel->get_user();
            if (count($users) > 0) {
                foreach ($users as $user) {
                    $members_info[$i] = array(
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'pseudo' => $user['pseudo'],
                        'notification_mails' => $user['notification_mails'],
                        'creation_date' => $user['creation_date'],
                        'posts_count' => count($this->PostModel->get_user_posts($user['id'])),
                        'comments_count' => count($this->CommentModel->get_user_comments($user['id'])),
                        'likes_count' => count($this->LikeModel->get_user_likes($user['id'])),
                    );
                    $i++;
                }
                $data['users'] = $members_info;
            }

            $this->loadView('templates/header');
            $this->loadView('admin/navbar', $data);
            $this->loadView('admin/members', $data);
            $this->loadView('templates/footer');
        }
    }

    public function posts()
    {
        if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
            include '404.php';
        } else {
            $this->loadModel('UserModel');
            $this->loadModel('PostModel');
            $this->loadModel('CommentModel');
            $this->loadModel('LikeModel');

            $data = array(
                'current' => "posts",
                'posts' => null,
            );
            $i = 0;
            $posts = $this->PostModel->get_all_posts();
            if (count($posts) > 0) {
                foreach ($posts as $post) {
                    $post_info[$i] = array(
                        'id' => $post['post_id'],
                        'author' => $this->UserModel->get_user('id', $post['user_id']),
                        'caption' => $post['caption'],
                        'image' => $post['img'],
                        'creation_date' => $post['creation_date'],
                        'comments_count' => count($this->CommentModel->get_post_comments($post['post_id'])),
                        'likes_count' => count($this->LikeModel->get_likes('post_id', $post['post_id'])),
                    );
                    $i++;
                }
                $data['posts'] = $post_info;
            }

            $this->loadView('templates/header');
            $this->loadView('admin/navbar', $data);
            $this->loadView('admin/posts', $data);
            $this->loadView('templates/footer');
        }
    }

    public function comments()
    {
        if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
            include '404.php';
        } else {
            $this->loadModel('UserModel');
            $this->loadModel('PostModel');
            $this->loadModel('CommentModel');
            $this->loadModel('LikeModel');

            $data = array(
                'current' => "comments",
                'comments' => null,
            );
            $i = 0;
            $comments = $this->CommentModel->get_comments();
            if (count($comments) > 0) {
                foreach ($comments as $comment) {
                    $comment_info[$i] = array(
                        'id' => $comment['comment_id'],
                        'author' => $this->UserModel->get_user('id', $comment['user_id']),
                        'content' => $comment['content'],
                        'creation_date' => $comment['creation_date'],
                        'post_id' => $comment['post_id']);
                    $i++;
                }
                $data['comments'] = $comment_info;
            }

            $this->loadView('templates/header');
            $this->loadView('admin/navbar', $data);
            $this->loadView('admin/comments', $data);
            $this->loadView('templates/footer');
        }
    }
}
