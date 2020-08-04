<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
			 }
		$this->load->model('m_profil');
		$this->load->library('upload');
	}
	
	public function index(){
		$role = $this->session->userdata('username');
		$data['profil'] = $this->m_profil->get_by_id($role);
		$this->template->load('template','profil/v_profil_list', $data);
	}

	
	public function update()
    {
        $row = $this->m_profil->get_by_id($this->session->userdata('username'));
	
        if ($row) {
			$data = array(
				'title' => 'Edit Profil',
				'action' => site_url('profil/update_action'),
				'username' => $row->username,
				'nama_user' => $row->nama_user
			);
            $this->template->load('template','profil/v_profil_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('profil'));
        }
    }

    public function update_action()
    {
		$username_lama = $this->session->userdata('username');
		$username = $this->input->post('f_username',TRUE);
		@$row = $this->m_profil->get_by_id($username);

		if ($row->username == $username_lama || @$row == null) {
			
			$data = array(
				'username' => $this->input->post('f_username',TRUE),
				'nama_user' => $this->input->post('f_nama_user',TRUE),
				'password' => md5($this->input->post('f_password',TRUE))
			);
			
			$db_debug = $this->db->db_debug; //save profil
			$this->db->db_debug = FALSE; //disable debugging for queries

			$this->m_profil->update($username_lama, $data);
			$error = $this->db->error();

			if ($error['code'] == 0) {
				$data_session = array(
					'username' => $username,
					'nama-user' => $this->input->post('f_nama_user',TRUE)
					);
	
				$this->session->set_userdata($data_session);

				$this->session->set_flashdata('message', '
				<div class="alert alert-success alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Sukses</strong></h4>
						<p>Data Berhasil Diubah!</p>
				</div>');
				redirect(site_url('profil'));
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
		else{
			$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. Username sudah ada!</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		

		
    }

    public function delete($id)
    {
        $row = $this->m_profil->get_by_id($id);

        if ($row) {
            $this->m_profil->delete($id);
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