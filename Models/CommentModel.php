<?php

class CommentModel extends Model
{
    public function create_comment($post_id, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO `Comments`
        (`comment_id`, `user_id`, `post_id`, `content`, `creation_date`)
        VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)");
        return ($stmt->execute([$_SESSION['id'], $post_id, $content]));
    }

    public function get_comment($key, $value)
    {
        $stmt = $this->db->prepare("SELECT * FROM Comments WHERE $key = ?");
        $stmt->execute([$value]);
        return $stmt->fetch();
    }

    public function delete_comment($key, $value)
    {
        $stmt = $this->db->prepare("DELETE FROM Comments WHERE $key = ?");
        return $stmt->execute([$value]);
    }

    public function get_user_comments($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Comments WHERE `user_id` = ?");
        if ($stmt->execute([$user_id])) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function get_post_comments($post_id)
    {
        $stmt = $this->db->prepare("SELECT Comments.*, Users.id AS user_id, Users.pseudo AS user_pseudo, Users.profil_pic
        FROM Comments INNER JOIN Users
        ON Comments.user_id = Users.id
        WHERE Comments.`post_id` = ? ORDER BY Comments.creation_date DESC");
        if ($stmt->execute([$post_id])) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function get_comments()
    {
        $stmt = $this->db->prepare("SELECT * FROM Comments");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
