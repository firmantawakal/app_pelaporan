<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_profil extends CI_Model {

	public $table = 'user';
    public $id = 'username';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}
	// update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
}
