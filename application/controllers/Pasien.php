<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pasien');
	}

	public function index()
	{
		$data['js'] = 'pasien';

		$this->load->view('header', $data);
		$this->load->view('pasien', $data);
		$this->load->view('footer', $data);
	}

	function load_data()
	{
		$data['pasien'] = $this->m_pasien->get_pasien_data();
		echo json_encode($data);
	}

	public function create()
	{
		if ($this->input->post('txnomorktp') != '') {
			$nama = $this->input->post('txnama');
			$jenis_kelamin = $this->input->post('txjeniskelamin');
			$tanggal_lahir = $this->input->post('txtanggallahir');
			$usia = $this->input->post('txusia');
			$golongan_darah = $this->input->post('txgolongandarah');
			$nomor_ktp = $this->input->post('txnomorktp');

			if (strlen($nomor_ktp) != 16) {
				$res['status'] = 'error';
				$res['msg'] = 'Nomor KTP harus terdiri dari 16 digit!';
				echo json_encode($res);
				return;
			}

			$this->db->where('pasienNomorKtp', $nomor_ktp);
			$cek_noktp = $this->db->get('pasien')->row();

			if ($cek_noktp) {
				$res['status'] = 'error';
				$res['msg'] = 'Nomor KTP sudah terdaftar!';
				echo json_encode($res);
				return;
			}

			$tanggalSewa = date('Y-m-d');
			$nomor_pasien = $this->nomor_pasien($tanggalSewa);


			$sql = "INSERT INTO pasien (pasienNama, pasienNomor, pasienJenisKelamin, pasienTanggalLahir, pasienUsia, pasienGolonganDarah, pasienNomorKtp, pasienStatus) 
                VALUES ('{$nama}', '{$nomor_pasien}', '{$jenis_kelamin}', '{$tanggal_lahir}', '{$usia}', '{$golongan_darah}', '{$nomor_ktp}', '1')";

			$exc = $this->db->query($sql);

			if ($exc) {
				$res['status'] = 'success';
				$res['msg'] = "Simpan data berhasil";
				$res['nomor_pasien'] = $nomor_pasien;
			} else {
				$res['status'] = 'error';
				$res['msg'] = "Simpan data gagal";
			}

			echo json_encode($res);
		}
	}


	public function nomor_pasien($tgl)
	{
		$sql = "SELECT IFNULL(
        (
            SELECT concat('KFAR', 
                DATE_FORMAT('$tgl', '%m%y'), 
                RIGHT(concat('000', RIGHT(pasienNomor, 3) + 1), 3)
            )
            FROM pasien
            WHERE pasienNomor LIKE concat('KFAR', DATE_FORMAT('$tgl', '%m%y'), '%')
            AND DATE_FORMAT(CURDATE(), '%Y%m') = DATE_FORMAT('$tgl', '%Y%m')  -- Menggunakan tanggal hari ini
            ORDER BY RIGHT(pasienNomor, 3) DESC
            LIMIT 1
        ),
        (
            SELECT concat('KFAR', DATE_FORMAT('$tgl', '%m%y'), '001')
        )
    ) AS nomor_pasien";

		$nomor_pasien = $this->db->query($sql)->row()->nomor_pasien;
		return $nomor_pasien;
	}

	public function edit_table()
	{
		$id = $this->input->post('id');
		$sql = $this->db->query("SELECT * FROM pasien WHERE pasienId = ?", array($id));
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
		$pasienNama = $this->input->post('pasienNama');
		$pasienJenisKelamin = $this->input->post('pasienJenisKelamin');
		$pasienTanggalLahir = $this->input->post('pasienTanggalLahir');
		$pasienUsia = $this->input->post('pasienUsia');
		$pasienGolonganDarah = $this->input->post('pasienGolonganDarah');
		$pasienNomorKtp = $this->input->post('pasienNomorKtp');

		$this->db->where('pasienId', $id);
		$update_data = array(
			'pasienNama' => $pasienNama,
			'pasienJenisKelamin' => $pasienJenisKelamin,
			'pasienTanggalLahir' => $pasienTanggalLahir,
			'pasienUsia' => $pasienUsia,
			'pasienGolonganDarah' => $pasienGolonganDarah,
			'pasienNomorKtp' => $pasienNomorKtp
		);

		if ($this->db->update('pasien', $update_data)) {
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
		$id = $this->input->post("id");
		$status = $this->input->post("status");

		if ($this->m_pasien->active_data($id, $status)) {
			$res["status"] = "success";
			$res["msg"] = "Status berhasil diubah";
		} else {
			$res["status"] = "error";
			$res["msg"] = "Gagal mengubah status";
		}

		echo json_encode($res);
	}

	public function delete_table()
	{
		$id = $this->input->post('id');
		if ($this->m_pasien->delete_pasien($id)) {
			$res['status'] = 'success';
			$res['msg'] = "Data pasien berhasil dihapus";
		} else {
			$res['status'] = 'error';
			$res['msg'] = "Gagal menghapus data pasien";
		}
		echo json_encode($res);
	}
}
