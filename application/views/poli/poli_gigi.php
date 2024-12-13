<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Poli Gigi</h1>
		<div class="text-right">
			<span class="badge badge-primary p-2">
				<i class="fas fa-calendar-alt"></i> <?= date('l, d F Y'); ?>
			</span>
		</div>
	</div>

	<div class="col-lg-12 row mb-3">
		<!-- Earnings (Annual) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4" id="cardMenunggu">
			<div class="card h-100">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Menunggu</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-clock fa-2x text-warning"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- New User Card Example -->
		<div class="col-xl-3 col-md-6 mb-4" id="cardDiperiksa">
			<div class="card h-100">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Diperiksa</div>
							<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-stethoscope fa-2x text-info"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4" id="cardSelesai">
			<div class="card h-100">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Selesai</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-check-circle fa-2x text-success"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!---Container Fluid-->

	<!-- DataTable with Hover -->
	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="table-responsive p-3">
				<div id="dataTableHover_wrapper" class="dataTables_wrapper dt-bootstrap4">
					<div class="row">
						<div class="col-sm-12">
							<table class="table align-items-center table-flush table-hover dataTable" id="dataTableHover" role="grid" aria-describedby="dataTableHover_info">
								<thead class="thead-light">
									<tr role="row">
										<th class="sorting_asc" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" aria-sort="ascending" style="width: 71.5781px;">Tanggal Periksa</th>
										<th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" style="width: 90.5938px;">Nomor Pasien</th>
										<th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" style="width: 90.5938px;">Keluhan</th>
										<th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" style="width: 90.5938px;">Poli</th>
										<th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" style="width: 66.9531px;">Faskes</th>
										<th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" style="width: 66.9531px;">Status Pemeriksaan</th>
										<th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" style="width: 69.9375px;">Edit</th>
										<th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1" colspan="1" style="width: 69.9375px;">Hapus</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="tanggal_periksa">Tanggal Periksa</label>
						<input type="date" class="form-control" id="txtanggalperiksa" readonly>
					</div>
					<div class="form-group">
						<label for="kode">Nomor Pasien</label>
						<input type="text" class="form-control" id="txkode" placeholder="Masukkan nomor pasien" required>
					</div>
					<!-- <div class="form-group">
						<label for="nama">Nama Pasien</label>
						<input type="text" class="form-control" id="txnama" placeholder="Masukkan nama pasien" disabled>
					</div> -->
					<div class="form-group">
						<label for="keluhan">Keluhan</label>
						<input type="text" class="form-control" id="txkeluhan" placeholder="Masukkan keluhan pasien" required>
					</div>
					<div class="form-group">
						<label for="poli_tujuan">Poli Tujuan</label>
						<select class="form-control" id="txpolitujuan" required>
							<option value="" disabled>Pilih poli tujuan</option>
							<option value="Poli Umum">Poli Umum</option>
							<option value="Poli Gizi">Poli Gizi</option>
							<option value="Poli Gigi">Poli Gigi</option>
						</select>
					</div>
					<div class="form-group">
						<label for="faskes">Faskes</label>
						<select class="form-control" id="txfaskes" required>
							<option value="" disabled>Pilih faskes</option>
							<option value="UMUM">UMUM</option>
							<option value="BPJS">BPJS</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary btn-closed" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary btn-edit" onclick="update_data()">Edit</button>
			</div>
		</div>
	</div>
</div>