<?php

class Post extends Controller
{
    public function index()
    {
        $this->loadModel('PostModel');
        $this->loadModel('UserModel');
        $this->loadModel('CommentModel');
        $this->loadModel('LikeModel');
        if (isset($_GET['post_id']) && is_numeric($_GET['post_id']) && $_GET['post_id'] > 0) {
            $post_id = $_GET['post_id'];
        } else {
            header('Location: /');
        }
        $post = $this->PostModel->get_post($post_id);
        if (!$post) {
            include '404.php';
        } else {
            $user = $this->UserModel->get_user('id', $post['user_id']);
            $comments = $this->CommentModel->get_post_comments($post['post_id']);
            $likes = $this->LikeModel->get_likes('post_id', $post['post_id']);

            $data = array(
                'post' => $post,
                'user' => $user,
                'comments' => $comments,
                'likes' => $likes,
                'user_liked' => '',
            );

            if (isset($_SESSION['id'])) {
                $data['user_liked'] = $this->LikeModel->user_liked($post['post_id'], $_SESSION['id']);
            }

            $this->loadView('templates/header');
            $this->loadView('post/index', $data);
            $this->loadView('templates/footer');
        }
    }

    public function delete_post()
    {
        $this->loadModel('PostModel');
        if (isset($_POST['post_id']) && is_numeric($_POST['post_id']) && $_POST['post_id'] > 0) {
            $post = $this->PostModel->get_post($_POST['post_id']);
            if ($post && $post['user_id'] == $_SESSION['id']) {
                $this->PostModel->delete_post($_POST['post_id']);
            }
            header('Location: /');
        } else if (isset($_GET['post_id']) && $_SESSION['role'] == "admin") {
            $this->PostModel->delete_post($_GET['post_id']);
            header('Location: /index.php/admin/posts');
        } else {
            header('Location: /');
        }
    }

    public function new_comment()
    {
        if (isset($_POST['comment_content']) && !empty($_POST['comment_content'])) {
            $this->loadModel('CommentModel');
            $this->loadModel('UserModel');
            $this->loadModel('PostModel');
            $this->loadModel('NotificationModel');

            $content = htmlspecialchars($_POST['comment_content']);
            $this->CommentModel->create_comment($_POST['post_id'], $content);
            $this->PostModel->increment_comments_to_post($_POST['post_id']);

            // Create notification
            $post = $this->PostModel->get_post($_POST['post_id']);
            $user = $this->UserModel->get_user('id', $post['user_id']);

            $this->NotificationModel->create_notification($user, $post['post_id'], "comment");
        }
        header('Location: /index.php/post?post_id=' . $_POST['post_id']);
    }

    public function like()
    {
        $this->loadModel('PostModel');
        $this->loadModel('LikeModel');
        $this->loadModel('NotificationModel');
        $this->loadModel('UserModel');

        // Check if post has been submitted
        if (isset($_POST['like']) && isset($_POST['post_id']) && is_numeric($_POST['post_id'])
            && $_POST['post_id'] > 0) {
            // Verify if post exists
            if ($this->PostModel->post_exists('post_id', $_POST['post_id'])) {
                $post = $this->PostModel->get_post($_POST['post_id']);
                // Determine if user liked or not and do appropriate function
                if ($this->LikeModel->user_liked($post['post_id'], $_SESSION['id']) == false) {
                    $this->LikeModel->like_post($post['post_id'], $_SESSION['id']);
                    $this->PostModel->increment_likes_to_post($post['post_id']);
                    $user = $this->UserModel->get_user('id', $post['user_id']);
                    $this->NotificationModel->create_notification($user, $post['post_id'], "like");
                    echo("like");
                } else {
                    $this->LikeModel->unlike_post($post['post_id'], $_SESSION['id']);
                    $this->PostModel->decrement_likes_to_post($post['post_id']);
                    echo("unlike");
                }
            }
        } else {
            include '404.php';
        }
    }
}
