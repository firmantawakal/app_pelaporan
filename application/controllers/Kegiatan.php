<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
			 }
		$this->load->model('m_kegiatan');
	}
	
	public function index(){
		$data['kegiatan'] = $this->m_kegiatan->get_all();
		$this->template->load('template','kegiatan/v_kegiatan_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah kegiatan',
				'action' => site_url('kegiatan/create_action'),
		);
		 $this->template->load('template','kegiatan/v_kegiatan_form',$data);
	}

	public function create_action()
	{
		$data = array(
				'nama_kegiatan' => $this->input->post('f_nama_kegiatan',TRUE)
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_kegiatan->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data berhasil ditambah!</p>
			</div>');
			redirect(site_url('kegiatan'));
		}
		elseif ($error['code'] == 1062) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. Data sudah ada!</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		else {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. '.$error['message'].'</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	public function update($id)
    {
        $row = $this->m_kegiatan->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title' => 'Edit kegiatan',
				'action' => site_url('kegiatan/update_action'),
				'id_kegiatan' => $row->id_kegiatan,
				'nama_kegiatan' => $row->nama_kegiatan,
			);
            $this->template->load('template','kegiatan/v_kegiatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('kegiatan'));
        }
    }

    public function update_action()
    {
		$id_kegiatan = $this->input->post('f_id_kegiatan',TRUE);

		$data = array(
			'nama_kegiatan' => $this->input->post('f_nama_kegiatan',TRUE),
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_kegiatan->update($id_kegiatan, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data Berhasil Diubah!</p>
			</div>');
			redirect(site_url('kegiatan'));
		}
		elseif ($error['code'] == 1062) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. Data sudah ada!</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		else {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. '.$error['message'].'</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

    public function delete($id)
    {
        $row = $this->m_kegiatan->get_by_id($id);

        if ($row) {
            $this->m_kegiatan->delete($id);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>    <i class="icon fa fa-check"></i> Sukses!</h4>Data Berhasil Dihapus
                </div>');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
?>