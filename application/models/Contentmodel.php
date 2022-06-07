<?php
class Contentmodel extends CI_Model
{
    public function getfield()
    {
        return $this->db->list_fields('content');
    }
    public function getalldata()
    {
        return $this->db->get('content')->result_array();
    }
    public function deletedata($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete('content');
    }
    public function insertdata($data)
    {
        $this->db->insert('content', $data);
    }
    public function getid($id)
    {
        return $this->db->get_where('content', ['category_id' => $id])->row_array();
    }
    public function updatedata($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
