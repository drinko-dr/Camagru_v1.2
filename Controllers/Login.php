<?php

class Login extends Controller
{
    public function index()
    {
        if (isset($_SESSION['pseudo'])) {
            header('Location: ' . WEBROOT);
        }
        $data = array(
            'error' => "",
            'pseudo' => "",
            'password' => "",
        );
        $this->loadModel('UserModel');
        if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
            $data['pseudo'] = trim(htmlspecialchars($_POST['pseudo']));
            $data['password'] = trim(htmlspecialchars($_POST['password']));

            if ($this->UserModel->user_exists($data['pseudo']) == false) {
                $data['error'] = 'Invalid credentials.';
            } else {
                $user = $this->UserModel->get_user('pseudo', $data['pseudo']);
                if ($user['mail_confirm'] == 0) {
                    header('Location: /index.php/register/confirm');
                } else if ($this->UserModel->login($user['pseudo'], $data['password']) == false) {
                    $data['error'] = "Wrong login or password.";
                } else {
                    header('Location: ' . WEBROOT);
                }
            }
        }
        $this->loadView('Templates/header');
        $this->loadView('Login/index', $data);
        $this->loadView('Templates/footer');
    }
}
