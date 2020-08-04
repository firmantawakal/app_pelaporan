<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
			 }
		$this->load->model('m_pengaduan');
		$this->load->model('m_upp');
		$this->load->library('fungsi');
	}
	
	public function index(){
		$role = $this->session->userdata('role');
		if ($role==1) {
			$data['pengaduan'] = $this->m_pengaduan->get_all_prov();
		}else{
			$data['pengaduan'] = $this->m_pengaduan->get_all($role);
		}
		$this->template->load('template','pengaduan/v_pengaduan_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah Pengaduan',
				'posko' => 0,
				'sms' => 0,
				'email' => 0,
				'telp' => 0,
				'upp' => $this->m_upp->get_all(),
				'action' => site_url('pengaduan/create_action'),
		);
		 $this->template->load('template','pengaduan/v_pengaduan_form',$data);
	}

	public function create_action()
	{
		$date = date("Y-m-d", strtotime($this->input->post('f_tgl_pengaduan',TRUE)));

		$data = array(
				'id_upp' => $this->input->post('f_id_upp',TRUE),
				'tgl_pengaduan' => $date,
				'posko' => $this->input->post('f_posko',TRUE),
				'sms' => $this->input->post('f_sms',TRUE),
				'email' => $this->input->post('f_email',TRUE),
				'telp' => $this->input->post('f_telp',TRUE)
				);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_pengaduan->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data berhasil ditambah!</p>
			</div>');
			redirect(site_url('pengaduan'));
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
        $row = $this->m_pengaduan->get_by_id($id);
	
        if ($row) {
			$date = date("d-m-Y", strtotime($row->tgl_pengaduan));
			$data = array(
				'title' => 'Edit Pengaduan',
				'action' => site_url('pengaduan/update_action'),
				'id_pengaduan' => $row->id_pengaduan,
				'tgl_pengaduan' => $date,
				'posko' => $row->posko,
				'sms' => $row->sms,
				'email' => $row->email,
				'telp' => $row->telp,
				'id_upp' => $row->id_upp,
				'upp' => $this->m_upp->get_all(),
			);
            $this->template->load('template','pengaduan/v_pengaduan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('pengaduan'));
        }
    }

    public function update_action()
    {
		$id_pengaduan = $this->input->post('f_id_pengaduan',TRUE);
		$date = date("Y-m-d", strtotime($this->input->post('f_tgl_pengaduan',TRUE)));

		$data = array(
				'id_upp' => $this->input->post('f_id_upp',TRUE),
				'tgl_pengaduan' => $date,
				'posko' => $this->input->post('f_posko',TRUE),
				'sms' => $this->input->post('f_sms',TRUE),
				'email' => $this->input->post('f_email',TRUE),
				'telp' => $this->input->post('f_telp',TRUE)
				);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_pengaduan->update($id_pengaduan, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data Berhasil Diubah!</p>
			</div>');
			redirect(site_url('pengaduan'));
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
        $row = $this->m_pengaduan->get_by_id($id);

        if ($row) {
            $this->m_pengaduan->delete($id);
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