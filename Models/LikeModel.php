<?php

class LikeModel extends Model
{
    public function get_user_likes($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Likes WHERE `user_id` = ? ORDER BY creation_date DESC");
        if ($stmt->execute([$user_id])) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function like_post($post_id, $user_id)
    {
        $stmt = $this->db->prepare("INSERT INTO `Likes` (`post_id`, `user_id`, `creation_date`)
                                              VALUES (?, ?, CURRENT_TIMESTAMP)");
        return ($stmt->execute([$post_id, $user_id]));
    }

    public function unlike_post($post_id, $user_id)
    {
        $stmt = $this->db->prepare("DELETE FROM `Likes` WHERE `Likes`.`post_id` = ? AND `Likes`.`user_id` = ?");
        return ($stmt->execute([$post_id, $user_id]));
    }

    public function user_liked($post_id, $user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Likes WHERE `post_id` = ? AND `user_id` = ?");
        $stmt->execute([$post_id, $user_id]);
        return (!empty($stmt->fetch()));
    }

    public function get_likes($key, $value)
    {
        $stmt = $this->db->prepare("SELECT * FROM Likes WHERE $key = ?");
        $stmt->execute([$value]);
        return ($stmt->fetchAll());
    }
}
