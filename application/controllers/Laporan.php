<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
			 }
		$this->load->model('m_laporan');
		$this->load->model('m_kegiatan');
		$this->load->model('m_upp');
		$this->load->library('upload');
		$this->load->library('fungsi');
	}
	
	public function index(){
		$role = $this->session->userdata('role');
		if ($role==1) {
			$data['laporan'] = $this->m_laporan->get_all_prov();
		}else{
			$data['laporan'] = $this->m_laporan->get_all($role);
		}
		$this->template->load('template','laporan/v_laporan_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah user',
				'kegiatan' => $this->m_kegiatan->get_all(),
				'upp' => $this->m_upp->get_all(),
				'action' => site_url('laporan/create_action'),
		);
		 $this->template->load('template','laporan/v_laporan_form',$data);
	}

	public function create_action()
	{
		$date = date("Y-m-d", strtotime($this->input->post('f_waktu_tgl',TRUE)));

		$data = array(
			'id_kegiatan' 	  => $this->input->post('f_id_kegiatan',TRUE),
			'id_upp'		  => $this->input->post('f_id_upp',TRUE),
			'waktu_tgl' 	  => $date,
			'waktu_jam1' 	  => $this->input->post('f_waktu_jam1',TRUE),
			'waktu_jam2' 	  => $this->input->post('f_waktu_jam2',TRUE),
			'tempat' 		  => $this->input->post('f_tempat',TRUE),
			'peserta' 		  => $this->input->post('f_peserta',TRUE),
			'pelaksana' 	  => $this->input->post('f_pelaksana',TRUE),
			'uraian_kegiatan' => $this->input->post('f_uraian_kegiatan',TRUE)
		);

		//upload foto
		$config['upload_path'] = './assets/images/laphar/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['f_dokumentasi']['name'])){
 
            if ($this->upload->do_upload('f_dokumentasi')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/images/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 400;
                $config['new_image']= './assets/images/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
                $data['dokumentasi']=$gbr['file_name'];
            }
                      
        }
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_laporan->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data berhasil ditambah!</p>
			</div>');
			redirect(site_url('laporan'));
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
        $row = $this->m_laporan->get_by_id($id);
		
        if ($row) {
			$date = date("d-m-Y", strtotime($row->waktu_tgl));

			$data = array(
				'title'			  => 'Edit Laporan',
				'action'		  => site_url('laporan/update_action'),
				'kegiatan'		  => $this->m_kegiatan->get_all(),
				'upp'			  => $this->m_upp->get_all(),
				'id_laporan' 	  => $row->id_laporan,
				'id_kegiatan' 	  => $row->id_kegiatan,
				'id_upp'		  => $row->id_upp,
				'waktu_tgl' 	  => $date,
				'waktu_jam1' 	  => $row->waktu_jam1,
				'waktu_jam2' 	  => $row->waktu_jam2,
				'tempat' 		  => $row->tempat,
				'peserta' 		  => $row->peserta,
				'pelaksana' 	  => $row->pelaksana,
				'uraian_kegiatan' => $row->uraian_kegiatan,
				'dokumentasi'	  => $row->dokumentasi
			);

            $this->template->load('template','laporan/v_laporan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('laporan'));
        }
    }

    public function update_action()
    {
		$id_laporan = $this->input->post('f_id_laporan',TRUE);
		$date = date("Y-m-d", strtotime($this->input->post('f_waktu_tgl',TRUE)));
		
		$data = array(
			'id_kegiatan' 	  => $this->input->post('f_id_kegiatan',TRUE),
			'id_upp'		  => $this->input->post('f_id_upp',TRUE),
			'waktu_tgl' 	  => $date,
			'waktu_jam1' 	  => $this->input->post('f_waktu_jam1',TRUE),
			'waktu_jam2' 	  => $this->input->post('f_waktu_jam2',TRUE),
			'tempat' 		  => $this->input->post('f_tempat',TRUE),
			'peserta' 		  => $this->input->post('f_peserta',TRUE),
			'pelaksana' 	  => $this->input->post('f_pelaksana',TRUE),
			'uraian_kegiatan' => $this->input->post('f_uraian_kegiatan',TRUE)
		);

		//upload foto
		$config['upload_path'] = './assets/images/laphar/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['f_dokumentasi']['name'])){
			
            if ($this->upload->do_upload('f_dokumentasi')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/images/laphar/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 400;
                $config['new_image']= './assets/images/laphar/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
				$data['dokumentasi']=$gbr['file_name'];

				$dokumentasi_lama = $this->input->post('f_dokumentasi_lama',TRUE);
				unlink("./assets/images/laphar/".$dokumentasi_lama);
			}
        }
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_laporan->update($id_laporan, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data Berhasil Diubah!</p>
			</div>');
			redirect(site_url('laporan'));
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
        $row = $this->m_laporan->get_by_id($id);

        if ($row) {
            $this->m_laporan->delete($id);
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
	
	public function print_laporan(){
		list($startDate1, $endDate1) = explode(' - ', $this->input->post('f_tgl',TRUE));
		$startDate = date("Y-m-d", strtotime(str_replace('/','-', $startDate1)));
		$endDate = date("Y-m-d", strtotime(str_replace('/','-', $endDate1)));
		$date = date("Y-m-d");

		$data['startDate'] = $startDate;
		$data['endDate'] = $endDate;
		$data['date'] = $date;
		$data['setting'] = $this->m_laporan->get_setting();
			// print_r($data);die;
		$this->template->load('template','laporan/v_laporan_print_preview', $data);
	}
	
	public function print_laporan_rekap(){
		list($startDate1, $endDate1) = explode(' - ', $this->input->post('f_tgl',TRUE));
		$startDate = date("Y-m-d", strtotime(str_replace('/','-', $startDate1)));
		$endDate = date("Y-m-d", strtotime(str_replace('/','-', $endDate1)));
		$date = date("Y-m-d");

		$data['startDate'] = $startDate;
		$data['endDate'] = $endDate;
		$data['date'] = $date;
		$data['kegiatan'] = $this->m_kegiatan->get_all();
		$data['upp'] = $this->m_upp->get_all();
		$data['setting'] = $this->m_laporan->get_setting();
		$this->template->load('template','laporan/v_laporan_print_rekap', $data);
	}
	
	public function print_go($dt){
		$data['date'] = $dt;
		// print_r($data);die;
		$this->load->view('laporan/v_laporan_print_go', $data);
	}
}
?>