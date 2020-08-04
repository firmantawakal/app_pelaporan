<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
			 }
		$this->load->model('m_user');
		$this->load->model('m_upp');
	}
	
	public function index(){
		$data['admin'] = $this->m_user->get_admin();
		$data['user'] = $this->m_user->get_all();
		$this->template->load('template','user/v_user_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah user',
				'action' => site_url('user/create_action'),
				'upp' => $this->m_upp->get_all(),
				'username' => '',
				'username_hid' => '',
				'nama_user' => ''
		);
		 $this->template->load('template','user/v_user_form',$data);
	}

	public function create_action()
	{
        $password = $this->input->post('f_password');

		$data = array(
				'username' => $this->input->post('f_username',TRUE),
				'password' => md5($password),
				'nama_user' => $this->input->post('f_nama_user',TRUE),
				'role_upp' => $this->input->post('f_role_upp',TRUE)
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_user->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data berhasil ditambah!</p>
			</div>');
			redirect(site_url('user'));
		}
		elseif ($error['code'] == 1062) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. Username sudah ada!</p>
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
        $row = $this->m_user->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title' => 'Edit user',
				'action' => site_url('user/update_action'),
				'upp' => $this->m_upp->get_all(),
				'username_hid' => $row->username,
				'username' => $row->username,
				'nama_user' => $row->nama_user
			);
            $this->template->load('template','user/v_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('user'));
        }
    }

    public function update_action()
    {
		$username = $this->input->post('f_username_hid',TRUE);
        $password = $this->input->post('f_password');

		$data = array(
			'username' => $this->input->post('f_username',TRUE),
			'nama_user' => $this->input->post('f_nama_user',TRUE),
			'password' => md5($password)
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_user->update($username, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data Berhasil Diubah!</p>
			</div>');
			redirect(site_url('user'));
		}
		elseif ($error['code'] == 1062) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. Username sudah ada!</p>
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
        $row = $this->m_user->get_by_id($id);

        if ($row) {
            $this->m_user->delete($id);
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