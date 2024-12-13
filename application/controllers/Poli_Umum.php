<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poli_Umum extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pasien');
		$this->load->model('m_rekammedis');
	}

	public function index()
	{
		$data['js'] = 'poli_umum';
		$this->load->view('header', $data);
		$this->load->view('poli/poli_umum', $data);
		$this->load->view('footer', $data);
	}

	function load_data()
	{
		$poli = $this->input->post('poli');
		$data['rekammedis'] = $this->m_rekammedis->get_data_by_poli('Poli Umum');
		echo json_encode($data);
	}

	public function edit_table()
	{
		$id = $this->input->post('id');
		$sql = $this->db->query("SELECT * FROM rekammedis WHERE rekamMedisId = ?", array($id));
		$result = $sql->row_array();
		if ($result > 0) {
			$res['status'] = 'ok';
			$res['data'] = $result;
			$res['msg'] = "Data {$id} sudah ada";
		} else {
			$res['status'] = 'error';
			$res['msg'] = "Data tidak ditemukan";
		}
		echo json_encode($res);
	}

	public function update_table()
	{
		$id = $this->input->post('id');
		$rekamMedisTanggalPeriksa = $this->input->post('rekamMedisTanggalPeriksa');
		$rekamMedisKode = $this->input->post('rekamMedisKode');
		$rekamMedisKeluhan = $this->input->post('rekamMedisKeluhan');
		$rekamMedisPoli = $this->input->post('rekamMedisPoli');
		$rekamMedisFaskes = $this->input->post('rekamMedisFaskes');

		$cek_pasien = $this->db->get_where('pasien', ['pasienNomor' => $rekamMedisKode])->row();
		if (!$cek_pasien) {
			echo json_encode([
				'status' => 'error',
				'msg' => 'Nomor pasien tidak dapat ditemukan'
			]);
			return;
		}
		
		$this->db->where('rekamMedisId', $id);
		$update_data = array(
			'rekamMedisTanggalPeriksa' => $rekamMedisTanggalPeriksa,
			'rekamMedisKode' => $rekamMedisKode,
			'rekamMedisKeluhan' => $rekamMedisKeluhan,
			'rekamMedisPoli' => $rekamMedisPoli,
			'rekamMedisFaskes' => $rekamMedisFaskes
		);

		if ($this->db->update('rekammedis', $update_data)) {
			$res['status'] = 'success';
			$res['msg'] = "Data berhasil diperbarui";
		} else {
			$res['status'] = 'error';
			$res['msg'] = "Gagal memperbarui data";
		}

		echo json_encode($res);
	}

	public function active()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		if (isset($id) && isset($status)) {
			$sql = "UPDATE rekammedis SET rekamMedisStatusPengaduan = ? WHERE rekamMedisId = ?";
			$this->db->query($sql, array($status, $id));

			if ($this->db->affected_rows() > 0) {
				echo json_encode(['status' => 'success', 'msg' => 'Status berhasil diubah']);
			} else {
				echo json_encode(['status' => 'error', 'msg' => 'Gagal mengubah status']);
			}
		} else {
			echo json_encode(['status' => 'error', 'msg' => 'ID atau status tidak ditemukan']);
		}
	}

	public function delete_table()
	{
		$id = $this->input->post('id');
		if ($this->m_rekammedis->delete_rekammedis($id)) {
			$res['status'] = 'success';
			$res['msg'] = "Data rekam medis berhasil dihapus";
		} else {
			$res['status'] = 'error';
			$res['msg'] = "Gagal menghapus data rekam medis";
		}
		echo json_encode($res);
	}
}
