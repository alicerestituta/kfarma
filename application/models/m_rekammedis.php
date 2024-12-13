<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rekammedis extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert_rekammedis($data)
	{
		return $this->db->insert('rekammedis', $data);
	}

	public function get_rekammedis_data()
	{
		$sql = "SELECT * FROM rekammedis WHERE rekamMedisHapus = 0 ORDER BY rekamMedisId";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function delete_rekammedis($id)
	{
		$sql = "UPDATE rekammedis SET rekamMedisHapus = 1 WHERE rekamMedisId='$id'";
		return $this->db->query($sql);
	}

	public function get_data_by_poli($poli)
	{
		$this->db->select('*'); 
		$this->db->where('rekamMedisPoli', $poli);
		$query = $this->db->get('rekammedis');
		return $query->result_array();
	}

	// public function getChartData() {
    //     // Query untuk mengambil jumlah pasien per hari (misalnya, dari tabel 'pasiens')
    //     // Misalnya, kita akan ambil data berdasarkan hari per minggu
    //     $query = $this->db->query("
    //         SELECT
    //             DAYOFWEEK(tanggal_periksa) AS hari,
    //             COUNT(*) AS jumlah_pasien
    //         FROM pasiens
    //         WHERE YEARWEEK(tanggal_periksa, 1) = YEARWEEK(CURDATE(), 1)  -- Mengambil data minggu ini
    //         GROUP BY DAYOFWEEK(tanggal_periksa)
    //         ORDER BY hari
    //     ");

    //     // Hasil query
    //     $result = $query->result_array();

    //     // Menyusun data untuk chart
    //     $labels = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    //     $data = [0, 0, 0, 0, 0, 0, 0]; // Inisialisasi data dengan 0

    //     // Menyusun data berdasarkan hari
    //     foreach ($result as $row) {
    //         $data[$row['hari']] = $row['jumlah_pasien'];
    //     }

    //     return [
    //         'labels' => $labels,
    //         'data' => $data
    //     ];
    // }
}
