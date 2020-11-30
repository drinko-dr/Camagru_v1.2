<?php

class Notification extends Controller
{
    public function index()
    {
        $this->loadModel('NotificationModel');

        $data = array(
            'notifications' => $this->NotificationModel->get_user_notifications('user_id', $_SESSION['id']),
        );
        $this->loadView('templates/header');
        $this->loadView('Notification/index', $data);
        $this->loadView('templates/footer');
    }

    public function delete()
    {
        if (isset($_GET['id']) && isset($_GET['user_id']) && is_numeric($_GET['id']) && is_numeric($_GET['user_id'])
            && $_GET['id'] > 0 && $_GET['user_id'] == $_SESSION['id']) {
            $this->loadModel('NotificationModel');

            $notif = $this->NotificationModel->get_notification('id', $_GET['id']);
            if ($notif['user_id'] == $_SESSION['id'] && $notif['user_id'] == $_GET['user_id']) {
                $this->NotificationModel->delete_notification($notif['id']);
                echo "deleted";
                header('Location: /index.php/notification/');
            } else {
                header('Location: /404.php');
            }
        } else {
            header('Location: /404.php');
        }
    }
}
