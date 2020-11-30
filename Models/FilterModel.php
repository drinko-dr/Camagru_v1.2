<?php

class FilterModel extends Model
{
    public function create_filter($path, $name)
    {
        $stmt = $this->db->prepare("INSERT INTO `Filters`
            (`id`, `path`, `name`, `creation_date`)
            VALUES (NULL, ?, ?, CURRENT_TIMESTAMP)");
        return $stmt->execute([$path, $name]);
    }

    public function get_filters()
    {
        $stmt = $this->db->prepare("SELECT * FROM Filters");
        $stmt->execute();
        return ($stmt->fetchAll());
    }

    public function get_filter_by_id($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Filters WHERE `id` = ?");
        $stmt->execute([$id]);
        return ($stmt->fetch());
    }

    public function delete_filter($filter_id)
    {
        $stmt = $this->db->prepare("DELETE FROM `Filters` WHERE `Filters`.`id` = ?");
        return $stmt->execute([$filter_id]);
    }

    public function filter_exists($name, $path)
    {
        $stmt = $this->db->prepare("SELECT * FROM Filters WHERE `name` = ? OR `path` = ?");
        $stmt->execute([$name, $path]);
        $res = $stmt->fetchAll();

        return (!empty($res));
    }
}
