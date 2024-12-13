<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		<div class="text-right">
			<span class="badge badge-primary p-2">
				<i class="fas fa-calendar-alt"></i> <?= date('l, d F Y'); ?>
			</span>
		</div>
	</div>

	<div class="row mb-3">
		<!-- Pasien Poli Umum -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card h-100">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Pasien Poli Umum</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $poli_umum; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pasien Poli Gizi -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card h-100">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Pasien Poli Gizi</div>
							<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $poli_gizi; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pasien Poli Gigi -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card h-100">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Pasien Poli Gigi</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $poli_gigi; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Total Pasien -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card h-100">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Total Pasien</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pasien; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Row-->

	<!-- Chart -->
	<div class="col-mb-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Statistik Kunjungan Pasien</h6>
			</div>
			<div class="card-body">
				<canvas id="pengunjungChart" width="600" height="180"></canvas>
			</div>
		</div>
	</div>

	<!-- Modal Logout -->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to logout?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
					<a href="login.html" class="btn btn-primary">Logout</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!---Container Fluid-->
</div>
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>
