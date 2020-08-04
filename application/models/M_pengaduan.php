<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_pengaduan extends CI_Model {

	public $table = 'pengaduan';
    public $id = 'id_pengaduan';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}
	
	function get_all($role)
    {
        $this->db->from('pengaduan');
        $this->db->join('upp', 'pengaduan.id_upp = upp.id_upp');
        $this->db->order_by('tgl_pengaduan', 'DESC');
        $this->db->where('pengaduan.id_upp', $role);
        $this->db->limit(500);
        return $this->db->get()->result();
	}
	
	function get_all_prov()
    {
        $this->db->from('pengaduan');
        $this->db->join('upp', 'pengaduan.id_upp = upp.id_upp');
        $this->db->order_by('tgl_pengaduan', 'DESC');
        $this->db->limit(500);
        return $this->db->get()->result();
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
