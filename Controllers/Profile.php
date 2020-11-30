<?php

class Profile extends Controller
{
    public function index()
    {
        $this->loadModel('PostModel');
        $this->loadModel('CommentModel');
        $this->loadModel('UserModel');
        $this->loadModel('LikeModel');

        if (isset($_GET['user'])) {
            if ($this->UserModel->user_exists(htmlspecialchars($_GET['user']))) {
                $user = $this->UserModel->get_user('pseudo', htmlspecialchars($_GET['user']));
                $posts = $this->PostModel->get_user_posts($user['id']);
                $comments = $this->CommentModel->get_user_comments($user['id']);
                $likes = $this->LikeModel->get_likes('user_id', $_SESSION['id']);

                $data = array(
                    'user' => $user,
                    'posts_count' => count($posts),
                    'posts' => $posts,
                    'comments_count' => count($comments),
                    'comments' => $comments,
                    'likes' => $likes,
                    'likes_count' => count($likes),
                );

                $this->loadView('templates/header', $data);
                $this->loadView('Profile/index', $data);
                $this->loadView('templates/footer');
            } else {
                include '404.php';
            }
        } else if (isset($_SESSION['id'])) {
            $user = $this->UserModel->get_user('id', $_SESSION['id']);
            $posts = $this->PostModel->get_user_posts($user['id']);
            $comments = $this->CommentModel->get_user_comments($user['id']);
            $likes = $this->LikeModel->get_likes('user_id', $_SESSION['id']);

            $data = array(
                'user' => $user,
                'posts_count' => count($posts),
                'posts' => $posts,
                'comments_count' => count($comments),
                'comments' => $comments,
                'likes' => $likes,
                'likes_count' => count($likes),
            );

            $this->loadView('templates/header', $data);
            $this->loadView('Profile/index', $data);
            $this->loadView('templates/footer');
        } else {
            include '404.php';
        }
    }

    public function edit()
    {
        if (!isset($_SESSION['pseudo'])) {
            header('Location: /');
        }
        $this->loadView('templates/header');
        $this->loadView('profile/edit');
        $this->loadView('templates/footer');
    }

    public function edit_form()
    {
        $this->loadModel('UserModel');
        if (!isset($_SESSION['pseudo'])) {
            header('Location: ' . WEBROOT);
        }
        $data = array(
            'error' => '',
            'success' => '',
            'notifications' => ($_SESSION['notification_mails'] == 0 ? "unchecked" : "checked"),
            'pseudo' => $_SESSION['pseudo'],
            'email' => $_SESSION['email'],
        );
        $error = 0;
        // Change pseudo if set, not empty, and different from current
        if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && $_POST['pseudo'] != $_SESSION['pseudo']) {
            $data['pseudo'] = trim(htmlspecialchars($_POST['pseudo']));
            if ($this->UserModel->pseudo_exists($data['pseudo']) && $data['pseudo'] != $_SESSION['pseudo']) {
                $data['error'] .= "Pseudo already taken. ";
                $error++;
            } else {
                $this->UserModel->update_user_key($_SESSION['id'], 'pseudo', $data['pseudo']);
                $error--;
            }
        }
        // Change email if set, not empty, and different from current
        if (isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] != $_SESSION['pseudo']) {
            $data['email'] = trim(htmlspecialchars($_POST['email']));
            if ($this->UserModel->email_exists($data['email']) && $data['email'] != $_SESSION['email']) {
                $data['error'] .= "Email already taken. ";
                $error++;
            } else {
                $this->UserModel->update_user_key($_SESSION['id'], 'email', $data['email']);
                $this->UserModel->login($data['pseudo'], $_SESSION['password']);
                $error--;
            }
        }
        // Change password if set, not empty and corresponds
        if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['password_confirm'])
            && !empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['password_confirm'])) {
            $data['old_password'] = trim(htmlspecialchars($_POST['old_password']));
            $data['new_password'] = trim(htmlspecialchars($_POST['new_password']));
            $data['password_confirm'] = trim(htmlspecialchars($_POST['password_confirm']));

            $user = $this->UserModel->get_user('pseudo', $data['pseudo']);
            $hash = hash('whirlpool', $data['old_password']);
            $pass_error = 0;

            if ($hash !== $user['password']) {
                $data['error'] .= "Your old password is wrong. ";
                $pass_error++;
            }if ($data['new_password'] !== $data['password_confirm']) {
                $data['error'] .= "Passwords don't match. ";
                $pass_error++;
				}if ($pass_error == 0) {
				$hash = hash('whirlpool', $data['new_password']);
                $this->UserModel->update_user_key($user['id'], 'password', $hash);
                $this->UserModel->login($data['pseudo'], $data['new_password']);
            } else {
                $data['error'] .= "Not cool.";
                $error++;
            }
        }
        // Checkbox for notifications mails
        if (isset($_POST['notifications'])) {
            $this->UserModel->update_user_key($_SESSION['id'], 'notification_mails', '1');
        } else {
            $this->UserModel->update_user_key($_SESSION['id'], 'notification_mails', '0');
        }
        if ($error < 0) {
            $this->loadView('Templates/header');
            $this->loadView('Profile/success');
            $this->loadView('Templates/footer');
        } else {
            $this->loadView('Templates/header');
            $this->loadView('Profile/edit', $data);
            $this->loadView('Templates/footer');
        }
    }

    public function update_profile_picture()
    {
        $this->loadModel('UserModel');
        if (isset($_POST['image'])) {
            $type = mime_content_type($_POST['image']);

            if ($type == "image/png" || $type == "image/jpeg") {
                $this->UserModel->update_user_key($_SESSION['id'], 'profil_pic', $_POST['image']);
            }
            header('Location: /index.php/profile');
        }
    }
}
