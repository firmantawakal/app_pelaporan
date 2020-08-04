<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_kegiatan extends CI_Model {

	public $table = 'kegiatan';
    public $id = 'id_kegiatan';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->order_by('nama_kegiatan', 'ASC');
        return $this->db->get($this->table)->row();
	}
	
	function get_all()
    {
        $this->db->order_by('nama_kegiatan', 'ASC');
        return $this->db->get($this->table)->result();
	}
	
	// insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
	}
	
	// update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
