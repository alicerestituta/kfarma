function load_data() {
	$.post(base_url + "poli_umum/load_data", {}, function (data) {
		console.log(data);

		// Hitung jumlah berdasarkan status
		let countMenunggu = 0;
		let countDiperiksa = 0;
		let countSelesai = 0;

		$.each(data.rekammedis, function (idx, val) {
			if (val['rekamMedisStatusPengaduan'] == 0) {
				countMenunggu++;
			} else if (val['rekamMedisStatusPengaduan'] == 1) {
				countDiperiksa++;
			} else if (val['rekamMedisStatusPengaduan'] == 2) {
				countSelesai++;
			}
		});

		// Perbarui jumlah pada card
		$('#cardMenunggu .h5').text(countMenunggu);
		$('#cardDiperiksa .h5').text(countDiperiksa);
		$('#cardSelesai .h5').text(countSelesai);

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

			let statusPengaduan = '';
			let badgeClass = 'bg-primary text-white';

			if (val['rekamMedisStatusPengaduan'] == 0) {
				statusPengaduan = 'Menunggu';
				badgeClass = 'bg-warning text-white';
			} else if (val['rekamMedisStatusPengaduan'] == 1) {
				statusPengaduan = 'Diperiksa';
				badgeClass = 'bg-info text-white';
			} else if (val['rekamMedisStatusPengaduan'] == 2) {
				statusPengaduan = 'Selesai';
				badgeClass = 'bg-success text-white';
			}

			html += '<td><span id="status_' + val['rekamMedisId'] + '" onclick="active_data(' + val['rekamMedisId'] + ', ' + val['rekamMedisStatusPengaduan'] + ')" class="badge ' + badgeClass + '">' + statusPengaduan + '</span></td>';
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

function edit_data(id) {
	$.post(base_url + 'poli_umum/edit_table', { id: id }, function (data) {
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
	} else {
		$.post(base_url + 'poli_umum/update_table', { id: id, rekamMedisTanggalPeriksa: rekamMedisTanggalPeriksa, rekamMedisKode: rekamMedisKode, rekamMedisKeluhan: rekamMedisKeluhan, rekamMedisPoli: rekamMedisPoli, rekamMedisFaskes: rekamMedisFaskes, }, function (data) {
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

function active_data(id, status) {
	console.log("ID:", id); 
    console.log("Status:", status);  

	if (status == 2) {
        Swal.fire({
            title: 'Gagal',
            text: 'Status sudah selesai dan tidak bisa diubah kembali',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    let newStatus;
    if (status == 0) {
        newStatus = 1; // Menunggu -> Diperiksa
    } else if (status == 1) {
        newStatus = 2; // Diperiksa -> Selesai
    } 

	console.log("New Status:", newStatus); 
	
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah yakin ingin mengubah status?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(base_url + "poli_umum/active", { id: id, status: newStatus }, function(data) {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: data.msg,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        load_data(); 
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: data.msg,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }, 'json');
        }
    });
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
			$.post(base_url + 'poli_umum/delete_table', { id: id }, function (data) {
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

function set_tanggal(inputId) {
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();

	today = yyyy + '-' + mm + '-' + dd;

	document.getElementById(inputId).value = today;
}

window.onload = function () {
	set_tanggal('txtanggalperiksa');
};
