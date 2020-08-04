<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_laporan extends CI_Model {

	public $table = 'laporan';
    public $id = 'id_laporan';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}

	function get_by_date($date)
    {
        $this->db->where('waktu_tgl', $date);
        $this->db->order_by('waktu_tgl', 'DESC');
        return $this->db->get($this->table)->result();
	}
	
	function get_all_prov()
    {
        $this->db->select('*');    
        $this->db->from('laporan');
        $this->db->join('upp', 'laporan.id_upp = upp.id_upp');
        $this->db->join('kegiatan', 'laporan.id_kegiatan = kegiatan.id_kegiatan');
        $this->db->order_by('waktu_tgl', 'DESC');
        $this->db->limit(500);
        return $this->db->get()->result();
	}
	
	function get_all($role)
    {
        $this->db->select('*');    
        $this->db->from('laporan');
        $this->db->join('upp', 'laporan.id_upp = upp.id_upp');
        $this->db->join('kegiatan', 'laporan.id_kegiatan = kegiatan.id_kegiatan');
        $this->db->order_by('waktu_tgl', 'DESC');
        $this->db->where('laporan.id_upp', $role);
        $this->db->limit(500);
        return $this->db->get()->result();
	}
	
	function get_setting()
    {
        $this->db->select('*');    
        $this->db->from('setting');
        return $this->db->get()->row();
	}
	
	// insert data
    function insert($data)
    {
        $this->db->insert('laporan', $data);
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
