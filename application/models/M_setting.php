<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_setting extends CI_Model {

	public $table = 'setting';
    public $id = 'id_setting';
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
