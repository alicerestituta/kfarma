function load_data() {
	$.post(base_url + "pasien/load_data", {}, function (data) {
		console.log(data);

		$("#dataTableHover").DataTable().clear().destroy();
		$("#dataTableHover > tbody").html('');

		let html = '';

		$.each(data.pasien, function (idx, val) {
			html += '<tr>';
			html += '<td>' + val['pasienNama'] + '</td>';
			html += '<td>' + val['pasienNomor'] + '</td>';
			html += '<td>' + val['pasienJenisKelamin'] + '</td>';
			html += '<td>' + val['pasienTanggalLahir'] + '</td>';
			html += '<td>' + val['pasienUsia'] + '</td>';
			html += '<td>' + val['pasienGolonganDarah'] + '</td>';
			html += '<td>' + val['pasienNomorKtp'] + '</td>';
			html += '<td><button class="btn btn-warning btn-sm btn-edit" onclick="edit_data(' + val['pasienId'] + ')"><i class="fas fa-edit"> </i></button></td>';
			html += '<td><button class="btn btn-danger btn-sm" onClick="delete_data(' + val['pasienId'] + ')"><i class="fas fa-trash"></i></button></td>';
			html += '</tr>';
		});

		$("#dataTableHover > tbody").append(html);

		$("#dataTableHover").DataTable({
			responsive: true,
			processing: true,
			pagingType: 'simple_numbers',
			lengthMenu: [10, 25, 50, 100],
			pageLength: 10,
			order: [],
			dom:
				"<'row'<'col-3'l><'col-9'f>>" +
				"<'row dt-row'<'col-sm-12'tr>>" +
				"<'row'<'col-4'i><'col-8'p>>",
			language: {
				info: "Halaman _PAGE_ dari _PAGES_",
				// lengthMenu: "MENU",
				search: "",
				searchPlaceholder: "Cari..."
			}
		});

	}, 'json');
}


$(document).ready(function () {
	$(".btn-closed").click(function () {
		reset_form();
		$('#addModal').modal('hide');
	});
	load_data();
});

// $(document).ready(function () {
// 	$('#addModal').modal('hide');
// });

function show_modal() {
	$(".btn-submit").show();
	$(".btn-edit").hide();
}

function reset_form() {
	$("#txnama").val('');
	$("#txjeniskelamin").val('');
	$("#txtanggallahir").val('');
	$("#txusia").val('');
	$("#txgolongandarah").val('');
	$("#txnomorktp").val('');
}

function simpan_data() {
	let nama = $("#txnama").val();
	let jenis_kelamin = $("#txjeniskelamin").val();
	let tanggal_lahir = $("#txtanggallahir").val();
	let usia = $("#txusia").val();
	let golongan_darah = $("#txgolongandarah").val();
	let nomor_ktp = $("#txnomorktp").val();

	console.log({
		txnama: nama,
		txjeniskelamin: jenis_kelamin,
		txtanggallahir: tanggal_lahir,
		txusia: usia,
		txgolongandarah: golongan_darah,
		txnomorktp: nomor_ktp,
	});

	if (nama === "" || jenis_kelamin === "" || tanggal_lahir === "" || usia === "" || golongan_darah === "" || nomor_ktp === "") {
		Swal.fire({
			title: 'Data Tidak Lengkap',
			text: 'Lengkapi semua data terlebih dahulu!',
			icon: 'warning',
			confirmButtonText: 'OK'
		});
	} else {
		$.post(base_url + "pasien/create", {
			txnama: nama,
			txjeniskelamin: jenis_kelamin,
			txtanggallahir: tanggal_lahir,
			txusia: usia,
			txgolongandarah: golongan_darah,
			txnomorktp: nomor_ktp,
		}, function (data) {
			console.log(data.status);
			if (data.status === "error") {
				Swal.fire({
					title: 'Error',
					text: data.msg,
					icon: 'error',
					confirmButtonText: 'OK'
				}).then(() => {

				});
			} else {
				Swal.fire({
					title: 'Berhasil',
					text: data.msg,
					icon: 'success',
					confirmButtonText: 'OK'
				}).then(() => {
					$("#addModal").modal('hide');
					load_data();
				});
			}
			$(".btn-submit").show();
			$(".btn-edit").hide();
		}, 'json');
	}
}

function edit_data(id) {
	$.post(base_url + 'pasien/edit_table', { id: id }, function (data) {
		$("#txnama").val(data.data.pasienNama);
		$("#txjeniskelamin").val(data.data.pasienJenisKelamin);
		$("#txtanggallahir").val(data.data.pasienTanggalLahir);
		$("#txusia").val(data.data.pasienUsia);
		$("#txgolongandarah").val(data.data.pasienGolonganDarah);
		$("#txnomorktp").val(data.data.pasienNomorKtp);
		$("#addModal").data('id', id);
		$("#addModal").modal('show');
		$(".btn-submit").hide();
		$(".btn-edit").show();
	}, 'json')
}


function update_data() {
	var id = $("#addModal").data('id');
	let pasienNama = $("#txnama").val();
	let pasienJenisKelamin = $("#txjeniskelamin").val();
	let pasienTanggalLahir = $("#txtanggallahir").val();
	let pasienUsia = $("#txusia").val();
	let pasienGolonganDarah = $("#txgolongandarah").val();
	let pasienNomorKtp = $("#txnomorktp").val();

	if (pasienNama === "" || pasienJenisKelamin === "" || pasienTanggalLahir === "" || pasienUsia === "" || pasienGolonganDarah === "" || pasienNomorKtp === "") {
		Swal.fire({
			title: 'Error!',
			text: 'Lengkapi semua data terlebih dahulu!',
			icon: 'warning',
			confirmButtonText: 'OK'
		});
		return;
		
	} else {
		$.post(base_url + 'pasien/update_table', { id: id, pasienNama: pasienNama, pasienJenisKelamin: pasienJenisKelamin, pasienTanggalLahir: pasienTanggalLahir, pasienUsia: pasienUsia, pasienGolonganDarah: pasienGolonganDarah, pasienNomorKtp: pasienNomorKtp }, function (data) {
			if (data.status === 'success') {
				Swal.fire({
					title: 'Success!',
					text: data.msg,
					icon: 'success',
					confirmButtonText: 'OK'
				}).then(() => {
					$("#addModal").modal('hide');
					load_data();
				});
			} else {
				Swal.fire({
					title: 'Error!',
					text: data.msg,
					icon: 'error',
					confirmButtonText: 'OK'
				})
			}
		}, 'json');
	}
}

// function active_data(id, status) {
// 	var newStatus = (status == 1) ? 0 : 1;  // Jika status 1 (UMUM) akan diubah jadi 0 (BPJS), dan sebaliknya

// 	Swal.fire({
// 		title: 'Konfirmasi',
// 		text: 'Apakah yakin ingin mengubah status?',
// 		icon: 'warning',
// 		showCancelButton: true,
// 		confirmButtonText: 'Ya',
// 		cancelButtonText: 'Batal'
// 	}).then((result) => {
// 		if (result.isConfirmed) {
// 			$.post(base_url + 'pasien/active', { id: id, status: newStatus }, function (data) {
// 				if (data.status === 'success') {
// 					Swal.fire({
// 						title: 'Sukses!',
// 						text: data.msg,
// 						icon: 'success',
// 						confirmButtonText: 'OK'
// 					}).then(() => {
// 						// Update tampilan status di halaman
// 						let newStatusText = (newStatus === 1) ? 'UMUM' : 'BPJS';
// 						let newClass = (newStatus === 1) ? 'bg-success' : 'bg-primary';

// 						// Update class dan text dari badge status
// 						$('span.badge[data-id="' + id + '"]')
// 							.removeClass('bg-success bg-primary') // Hapus kelas lama
// 							.addClass(newClass) // Tambahkan kelas baru
// 							.text(newStatusText); // Ubah teks status
// 						load_data();
// 					});
// 				} else {
// 					Swal.fire({
// 						title: 'Gagal!',
// 						text: data.msg,
// 						icon: 'error',
// 						confirmButtonText: 'OK'
// 					});
// 				}
// 			}, 'json');
// 		}
// 	});
// }

function delete_data(id) {
	Swal.fire({
		title: 'Konfirmasi',
		text: 'Yakin ingin menghapus data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
		cancelButtonText: 'Batal',
		reverseButtons: true,
		customClass: {
			confirmButton: 'btn btn-primary',
			cancelButton: 'btn btn-danger'
		}
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(base_url + 'pasien/delete_table', { id: id }, function (data) {
				if (data.status === 'success') {
					Swal.fire({
						title: 'Berhasil',
						text: 'Data berhasil dihapus!',
						icon: 'success',
						confirmButtonText: 'OK'
					}).then(() => {
						$("#addModal").modal('hide');
						load_data();
					});
				} else {
					Swal.fire({
						title: 'Error!',
						text: data.msg || 'Gagal menghapus data',
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			}, 'json');
		} else {
			Swal.fire({
				title: 'Dibatalkan',
				text: 'Penghapusan data dibatalkan',
				icon: 'info',
				confirmButtonText: 'OK'
			});
		}
	});
}
