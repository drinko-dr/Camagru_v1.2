<?php

class User extends Controller
{
    public function disconnect()
    {
        session_destroy();
        header('Location: /');
    }

    public function forgot_password()
    {
        $data = array();

        if (isset($_POST['email']) && isset($_POST['token'])
            && $_POST['token'] == $_SESSION['token']) {
            $this->loadModel('UserModel');
            $mail = str_replace(array("\n", "\r", PHP_EOL), '', htmlspecialchars($_POST['email']));
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                if ($this->UserModel->change_password($mail)) {
                    session_destroy();
                    header('Location: /index.php/user/password_reset');
                } else {
                    $data['error'] = 'An error occured. Please try again.';
                }
            }
        }
        $this->loadView('templates/header');
        $this->loadView('user/forgot_password', $data);
        $this->loadView('templates/footer');
    }

    public function password_reset()
    {
        $this->loadView('templates/header');
        $this->loadView('user/password_reset');
        $this->loadView('templates/footer');
    }
}
