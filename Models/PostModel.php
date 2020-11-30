<?php

class PostModel extends Model
{
    public function get_user_posts($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Posts WHERE `user_id` = ? ORDER BY creation_date DESC");
        if ($stmt->execute([$user_id])) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function get_all_posts()
    {
        $stmt = $this->db->prepare("SELECT * FROM Posts ORDER BY `creation_date` DESC");
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function get_post($post_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Posts WHERE `post_id` = ?");
        if ($stmt->execute([$post_id])) {
            return $stmt->fetch();
        }
    }

    public function create_post($image, $caption)
    {
        $stmt = $this->db->prepare("INSERT INTO `Posts`
		(`post_id`, `user_id`, `caption`, `img`, `likes_count`, `creation_date`)
		VALUES (NULL, ?, ?, ?, '0', CURRENT_TIMESTAMP);");
        return $stmt->execute([$_SESSION['id'], $caption, $image]);
    }

    public function increment_comments_to_post($post_id)
    {
        $stmt = $this->db->prepare("UPDATE Posts SET comments_count = comments_count + 1 WHERE post_id = ?");
        $stmt->execute([$post_id]);
    }

    public function increment_likes_to_post($post_id)
    {
        $stmt = $this->db->prepare("UPDATE Posts SET likes_count = likes_count + 1 WHERE post_id = ?");
        $stmt->execute([$post_id]);
    }

    public function decrement_comments_to_post($post_id)
    {
        $stmt = $this->db->prepare("UPDATE Posts SET comments_count = comments_count - 1 WHERE post_id = ?");
        $stmt->execute([$post_id]);
    }

    public function decrement_likes_to_post($post_id)
    {
        $stmt = $this->db->prepare("UPDATE Posts SET likes_count = likes_count - 1 WHERE post_id = ?");
        $stmt->execute([$post_id]);
    }

    public function get_paginated_posts($maximg, $debut)
    {
        $stmt = $this->db->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM Posts ORDER BY `creation_date` DESC LIMIT :maximg OFFSET :debut");
        $stmt->bindValue('maximg', $maximg, PDO::PARAM_INT);
        $stmt->bindValue('debut', $debut, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $imagetablen = $this->db->query('SELECT found_rows()');
        $data['totalposts'] = $imagetablen->fetchColumn();
        $data['nbpage'] = ceil($data['totalposts'] / $maximg);
        $data['posts'] = $posts;

        return $data;
    }

    public function post_exists($key, $value)
    {
        $stmt = $this->db->prepare("SELECT * FROM Posts WHERE $key = ?");
        $stmt->execute([$value]);
        return (!empty($stmt->fetch()));
    }

    public function get_post_likes($post_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Likes WHERE post_id = ?");
        $stmt->execute([$post_id]);
        return $stmt->fetchAll();
    }

    public function delete_post($post_id)
    {
        $stmt = $this->db->prepare("DELETE FROM `Posts` WHERE `Posts`.`post_id` = ?");
        return $stmt->execute([$post_id]);
    }
}
