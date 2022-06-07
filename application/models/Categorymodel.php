<?php
class Categorymodel extends CI_Model
{
    public function getfield()
    {
        return $this->db->list_fields('category');
    }
    public function getalldata()
    {
        return $this->db->get('category')->result_array();
    }
    public function deletedata($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('category');
    }
    public function insertdata($data)
    {
        $this->db->insert('category', $data);
    }
    public function getid($id)
    {
        return $this->db->get_where('category', ['id' => $id])->row_array();
    }
    public function updatedata($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
