<?php

class Activation extends Controller
{
    public function index()
    {
        if (isset($_GET['log']) && isset($_GET['key']))
        {
            $this->loadModel('UserModel');
            $data = array();
            $login = trim(htmlspecialchars($_GET['log']));
            $key = trim(htmlspecialchars($_GET['key']));
            if ($this->UserModel->user_exists($login)) {
                $user = $this->UserModel->get_user('pseudo', $login);
                if ($user['active_key'] == $key) {
                    // If not confirmed, confirm user
                    if ($user['mail_confirm'] == 0) {
                        $this->UserModel->confirm_user($user['id']);
                        $data['success'] = "Ваш адрес электронной почты был успешно подтвержден. Пожалуйста, войдите.";
                    } else { // User already confirmed
                        $data['already_confirmed'] = "Этот электронный адрес уже подтвержден. Пожалуйста, <a href='/index.php/login'>войдите в систему</a>.";
                    }
                } else { // Wrong activation key
                    $data['error'] = "Возникла проблема с активацией. Возможно, у вас нет нужного ключа активации. Пожалуйста, подтвердите ссылку в своем электронном ящике.";
                }
            }
            $this->loadView('templates/header');
            $this->loadView('activation/index', $data);
            $this->loadView('templates/footer');
        } else {
            include('404.php');
        }
    }

    public function resend()
    {
        $this->loadModel('UserModel');
        $data = array();
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $data['email'] = trim(htmlspecialchars($_POST['email']));
            if ($this->UserModel->user_exists('', $data['email'])) {
                $user = $this->UserModel->get_user('email', $data['email']);
                $this->UserModel->send_confirmation_mail($user['email'], $user['pseudo'], $user['active_key']);
                $data['email_sended'] = "Было отправлено новое письмо для активации, проверьте свой электронный ящик.";
            } else {
                $data['error'] = "Нет учетной записи с этим адресом электронной почты.";
            }
        }
        $this->loadView('templates/header');
        $this->loadview('activation/resend', $data);
        $this->loadView('templates/footer');
    }
}