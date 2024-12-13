function load_data() {
	$.post(base_url + "rekam_medis/load_data", {}, function (data) {
		console.log(data);

		$("#dataTableHover").DataTable().clear().destroy();
		$("#dataTableHover > tbody").html('');

		let html = '';

		$.each(data.rekammedis, function (idx, val) {
			html += '<tr>';
			html += '<td>' + val['rekamMedisTanggalPeriksa'] + '</td>';
			html += '<td>' + val['rekamMedisKode'] + '</td>';
			html += '<td>' + val['rekamMedisKeluhan'] + '</td>';
			html += '<td>' + val['rekamMedisPoli'] + '</td>';
			html += '<td>' + val['rekamMedisFaskes'] + '</td>';
			// html += '<td><span onclick="active_data(' + val['pasienId'] + ',' + val['pasienStatus'] + ')" class="badge ' + ((val['pasienStatus'] == '1') ? 'bg-success text-white' : 'bg-primary text-white') + '">' + ((val['pasienStatus'] == '1') ? 'UMUM' : 'BPJS') + '</span></td>';
			html += '<td><button class="btn btn-warning btn-sm btn-edit" onclick="edit_data(' + val['rekamMedisId'] + ')"><i class="fas fa-edit"> </i></button></td>';
			html += '<td><button class="btn btn-danger btn-sm" onClick="delete_data(' + val['rekamMedisId'] + ')"><i class="fas fa-trash"></i></button></td>';
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

$(document).ready(function () {
	$('#addModal').modal('hide');
});

function show_modal() {
	$(".btn-submit").show();
	$(".btn-edit").hide();
}

function reset_form() {
	$("#txkode").val('');
	$("#txkeluhan").val('');
	$("#txpolitujuan").val('');
	$("#txfaskes").val('');
	$(".btn-tambah").val('');
}

function simpan_data() {
	let tanggal_periksa = $("#txtanggalperiksa").val();
	let kode = $("#txkode").val();
	let keluhan = $("#txkeluhan").val();
	let poli_tujuan = $("#txpolitujuan").val();
	let faskes = $("#txfaskes").val();

	console.log({
		txtanggalperiksa: tanggal_periksa,
		txkode: kode,
		txkeluhan: keluhan,
		txpolitujuan: poli_tujuan,
		txfaskes: faskes,
	});

	if (tanggal_periksa === "" || kode === "" || keluhan === "" || poli_tujuan === "" || faskes === "") {
		Swal.fire({
			title: 'Data Tidak Lengkap',
			text: 'Lengkapi semua data terlebih dahulu!',
			icon: 'warning',
			confirmButtonText: 'OK'
		});
	} else {
		$.post(base_url + "rekam_medis/create", {
			txtanggalperiksa: tanggal_periksa,
			txkode: kode,
			txkeluhan: keluhan,
			txpolitujuan: poli_tujuan,
			txfaskes: faskes,
		}, function (data) {
			console.log(data.status);
			if (data.status === "error") {
				if (data.msg === 'Kode pasien tidak ditemukan') {
					Swal.fire({
						title: 'Error',
						text: data.msg,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
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
	$.post(base_url + 'rekam_medis/edit_table', { id: id }, function (data) {
		$("#txtanggalperiksa").val(data.data.rekamMedisTanggalPeriksa);
		$("#txkode").val(data.data.rekamMedisKode);
		$("#txkeluhan").val(data.data.rekamMedisKeluhan);
		$("#txpolitujuan").val(data.data.rekamMedisPoli);
		$("#txfaskes").val(data.data.rekamMedisFaskes);
		$("#addModal").data('id', id);
		$("#addModal").modal('show');
		$(".btn-submit").hide();
		$(".btn-edit").show();
	}, 'json')
}

function update_data() {
	var id = $("#addModal").data('id');
	let rekamMedisTanggalPeriksa = $("#txtanggalperiksa").val();
	let rekamMedisKode = $("#txkode").val();
	let rekamMedisKeluhan = $("#txkeluhan").val();
	let rekamMedisPoli = $("#txpolitujuan").val();
	let rekamMedisFaskes = $("#txfaskes").val();

	if (rekamMedisTanggalPeriksa === "" || rekamMedisKode === "" || rekamMedisKeluhan === "" || rekamMedisPoli === "" || rekamMedisFaskes === "") {
		Swal.fire({
			title: 'Error!',
			text: 'Lengkapi semua data terlebih dahulu!',
			icon: 'warning',
			confirmButtonText: 'OK'
		});
		return;
	}

	$.post(base_url + 'rekam_medis/update_table', {
		id: id,
		rekamMedisTanggalPeriksa: rekamMedisTanggalPeriksa,
		rekamMedisKode: rekamMedisKode,
		rekamMedisKeluhan: rekamMedisKeluhan,
		rekamMedisPoli: rekamMedisPoli,
		rekamMedisFaskes: rekamMedisFaskes,
	}, function (data) {
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
			});
		}
	}, 'json');
}

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
			$.post(base_url + 'rekam_medis/delete_table', { id: id }, function (data) {
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

function setTodayDate() {
	const today = new Date();
	const yyyy = today.getFullYear();
	const mm = String(today.getMonth() + 1).padStart(2, '0');
	const dd = String(today.getDate()).padStart(2, '0');

	const todayDate = `${yyyy}-${mm}-${dd}`;
	const element = document.getElementById('txtanggalperiksa');
	if (element) {
		element.value = todayDate;
	}
}

setTodayDate();

setInterval(() => {
	setTodayDate();
}, 24 * 60 * 60 * 1000);

window.onload = function () {
	function loadChartData() {
		$.get(base_url + 'rekam_medis/chart_pasien', function (response) {
			try {
				const data = JSON.parse(response);

				const hariIndonesia = {
					'Monday': 'Senin',
					'Tuesday': 'Selasa',
					'Wednesday': 'Rabu',
					'Thursday': 'Kamis',
					'Friday': 'Jumat',
					'Saturday': 'Sabtu',
					'Sunday': 'Minggu'
				};

				const labelsIndo = data.labels.map(hari => hariIndonesia[hari] || hari);

				const chartData = {
					labels: labelsIndo,
					datasets: [{
						label: 'Jumlah Pasien',
						data: data.data,
						backgroundColor: 'rgba(103, 119, 239, 0.5)',
						borderColor: 'rgba(103, 119, 239, 1)',
						borderWidth: 1
					}]
				};

				const config = {
					type: 'bar',
					data: chartData,
					options: {
						responsive: true,
						plugins: {
							legend: { position: 'top' },
							tooltip: { enabled: true }
						},
						scales: {
							y: { beginAtZero: true }
						}
					}
				};

				const ctx = document.getElementById('pengunjungChart').getContext('2d');
				new Chart(ctx, config);
			} catch (error) {
				console.error('Error parsing chart data:', error);
			}
		}).fail(function () {
			console.error('Failed to fetch chart data.');
		});
	}

	loadChartData();
};

$(document).ready(function() {
    $('#txkode').on('input', function() {
        var kodePasien = $(this).val(); 
        
        if (kodePasien) {
            $.ajax({
				url: 'http://localhost/kfarma/rekam_medis/tampil_nama_pasien',
                method: 'GET',
                data: { kode: kodePasien },  
                success: function(response) {
					console.log(response);  
					var data = JSON.parse(response); 
					if (data.nama) {
						$('#txnama').val(data.nama); 
					} else {
						$('#txnama').val(''); 
					}
				},
				
                error: function() {
                    alert('Terjadi kesalahan.');
                }
            });
        } else {
            $('#txnama').val(''); 
        }
		
    });
});
