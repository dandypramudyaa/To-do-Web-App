<?php

class Todo_model extends CI_model
{

    public function getAllTodo($id)
    {

        $query = $this->db->query("SELECT * FROM tasklist INNER JOIN user ON tasklist.id_user = user.id_user WHERE tasklist.id_user = $id ORDER BY tasklist.tanggal ASC");
        return $query->result_array();
    }
}
