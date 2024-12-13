<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekam_Medis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('m_pasien');
		$this->load->model('m_rekammedis');
	}

	public function index()
	{
		$data['js'] = 'rekam_medis';

		$this->load->view('header', $data);
		$this->load->view('rekam_medis', $data);
		$this->load->view('footer', $data);
	}

	function load_data()
	{
		$data['rekammedis'] = $this->m_rekammedis->get_rekammedis_data();
		echo json_encode($data);
	}

	public function create()
	{
		$tanggal_periksa = $this->input->post('txtanggalperiksa');
		$kode = $this->input->post('txkode');
		$keluhan = $this->input->post('txkeluhan');
		$poli_tujuan = $this->input->post('txpolitujuan');
		$faskes = $this->input->post('txfaskes');

		$this->db->where('pasienNomor', $kode);
		$query = $this->db->get('pasien');

		if ($query->num_rows() == 0) {
			$res['status'] = 'error';
			$res['msg'] = 'Kode pasien tidak ditemukan';
			echo json_encode($res);
			return;
		}

		$sql = "INSERT INTO rekammedis (rekamMedisTanggalPeriksa, rekamMedisKode, rekamMedisKeluhan, rekamMedisPoli, rekamMedisFaskes) 
            VALUES ('{$tanggal_periksa}','{$kode}','{$keluhan}','{$poli_tujuan}','{$faskes}')";

		$exc = $this->db->query($sql);

		if ($exc) {
			$res['status'] = 'success';
			$res['msg'] = "Simpan data berhasil";
		} else {
			$res['status'] = 'error';
			$res['msg'] = "Simpan data gagal";
		}

		echo json_encode($res);
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
				'msg' => 'Kode pasien tidak dapat ditemukan'
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
			echo json_encode([
				'status' => 'success',
				'msg' => 'Data berhasil diperbarui'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'msg' => 'Gagal memperbarui data'
			]);
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

	public function tampil_nama_pasien() {
		$kodePasien = $this->input->get('kode');
	
		$this->load->database();
	
		$this->db->select('pasienNama');
		$this->db->from('pasien');
		$this->db->where('pasienNomor', $kodePasien);
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			$data = $query->row();
			echo json_encode(['nama' => $data->pasienNama]); 
		} else {
			echo json_encode(['nama' => '']); 
		}
	}

	public function chart_pasien()
	{
		$this->load->database();

		$query = $this->db->query("
	    SELECT 
	        DAYNAME(rekamMedisTanggalPeriksa) AS hari,
	        CAST(COUNT(*) AS UNSIGNED) AS jumlah
	    FROM rekammedis
	    GROUP BY DAYNAME(rekamMedisTanggalPeriksa)
	    ORDER BY FIELD(DAYNAME(rekamMedisTanggalPeriksa), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
	");

		$result = $query->result_array();

		$hari_indonesia = [
			'Monday' => 'Senin',
			'Tuesday' => 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' => 'Kamis',
			'Friday' => 'Jumat',
			'Saturday' => 'Sabtu',
			'Sunday' => 'Minggu'
		];

		foreach ($result as &$row) {
			$row['hari'] = $hari_indonesia[$row['hari']];
		}

		$data = [
			'labels' => array_column($result, 'hari'),
			'data' => array_map('intval', array_column($result, 'jumlah'))
		];

		echo json_encode($data);
	}
}
