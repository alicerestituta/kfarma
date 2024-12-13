<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_rekammedis');
	}

	public function index()
	{
		$data['js'] = 'rekam_medis';

		$data['total_pasien'] = count($this->db->get('rekammedis')->result_array());
		$data['poli_umum'] = count($this->m_rekammedis->get_data_by_poli('Poli Umum'));
		$data['poli_gigi'] = count($this->m_rekammedis->get_data_by_poli('Poli Gigi'));
		$data['poli_gizi'] = count($this->m_rekammedis->get_data_by_poli('Poli Gizi'));

		$this->load->view('header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('footer', $data);
	}
}
