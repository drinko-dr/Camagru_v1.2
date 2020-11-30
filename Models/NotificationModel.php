<?php

class NotificationModel extends Model
{
    public function create_notification($user, $post_id, $type)
    {
        $stmt = $this->db->prepare("INSERT INTO `Notifications`
        (`id`, `user_id`, `post_id`, `object`, `content`, `creation_date`)
        VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)");

        if ($user['notification_mails'] == 1) {
            $to = $user['email'];
            $subject = $type == "comment" ? "New comment on your post" : "New like on your post";
            $header = "From: no-reply@camagru.fr";
            $content = 'You have a ' . $subject . '. Visit :
            https://camagru-dr.loc//index.php/post?post_id=' . $post_id .'
            ---------------
			This mail was send automatically, please do not reply.';
            mail($to, $subject, $content, $header);
        }
        if ($type == "comment") {
            return $stmt->execute([$user['id'], $post_id, "Новый комментарий", $_SESSION['pseudo'] . " только что прокомментировал ваш пост. Нажмите, чтобы увидеть!"]);
        } else if ($type == "like") {
            return $stmt->execute([$user['id'], $post_id, "Новый лайк", $_SESSION['pseudo'] . " понравился ваш пост. Нажмите, чтобы увидеть!"]);
        }
    }

    public function get_user_notifications($key, $value)
    {
        $stmt = $this->db->prepare("SELECT * FROM Notifications WHERE `user_id` = ? ORDER BY `creation_date` DESC");
        $stmt->execute([$_SESSION['id']]);
        return ($stmt->fetchAll());
    }

    public function get_notification($key, $value)
    {
        $stmt = $this->db->prepare("SELECT * FROM Notifications WHERE $key = ?");
        $stmt->execute([$value]);
        return ($stmt->fetch());
    }

    public function delete_notification($notif_id)
    {
        $stmt = $this->db->prepare("DELETE FROM `Notifications` WHERE `id` = ?");
        return $stmt->execute([$notif_id]);
    }
}
