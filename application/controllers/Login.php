<?php
Class Login extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('m_login');
    }

    function index(){
        $this->load->view('login/v_login');
    }

    function aksi_login(){
		$username = $this->input->post('login-username');
        $password = $this->input->post('login-password');
        
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_login->cek_login("user",$where)->num_rows();
		if($cek > 0){
      $data = $this->m_login->get_by_id($username);
			$data_session = array(
				'username' => $username,
				'nama-user' => $data->nama_user,
				'role' => $data->role_upp,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(site_url("laporan"));

		}
    else{
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" id="success-alert">
          <p>Login Gagal. '.$error['message'].'</p>
      </div>');
      redirect($_SERVER['HTTP_REFERER']);
		}

	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

?>
