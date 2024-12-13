<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pasien extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert_pasien($data)
	{
		return $this->db->insert('pasien', $data);
	}

	public function get_pasien_data()
	{
		$sql = "SELECT * FROM pasien WHERE pasienHapus = 0 ORDER BY pasienId";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_pasien_by_id($id)
	{
		$this->db->where('pasienId', $id);
		$query = $this->db->get('pasien');
		if ($query->num_rows() > 0) {
			return $query->row(); // Mengembalikan data pasien
		}
		return false; // Mengembalikan false jika tidak ditemukan
	}

	public function update_pasien($id, $data)
	{
		$this->db->where('pasienId', $id);
		return $this->db->update('pasien', $data);
	}

	public function delete_pasien($id)
	{
		$sql = "UPDATE pasien SET pasienHapus = 1 WHERE pasienId='$id'";
		return $this->db->query($sql);
	}

	// public function active_data($id, $status)
	// {
	// 	$sql = "UPDATE pasien SET pasienStatus = ? WHERE pasienId = ?";
	// 	return $this->db->query($sql, array($status, $id)); 
	// }
}
