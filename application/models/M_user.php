<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_user extends CI_Model {

	public $table = 'user';
    public $id = 'username';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->order_by('username', 'ASC');
        return $this->db->get($this->table)->row();
	}
	
	function get_all()
    {
        $this->db->select('*');    
        $this->db->from('user');
        $this->db->join('upp', 'user.role_upp = upp.id_upp');
        return $this->db->get()->result();
    }
    
	function get_admin()
    {
        $this->db->select('*');    
        $this->db->from('user');
        $this->db->where('role_upp', 99);
        return $this->db->get()->result();
	}
	
	// insert data
    function insert($data)
    {
        $this->db->insert('user', $data);
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
