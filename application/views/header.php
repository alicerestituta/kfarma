<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="assets/img/logo.png" rel="icon">
	<title>KFarma</title>
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/ruang-admin.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.css"> -->
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- Sidebar -->
		<ul class="navbar-nav sidebar sidebar-light accordion toggled" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('dashboard'); ?>">
				<div class="sidebar-brand-icon">
					<img src="assets/img/logo.png">
				</div>
				<div class="sidebar-brand-text mx-3">KFarma</div>
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
					<i class="fas fa-fw fa-home"></i>
					<span>Dashboard</span></a>
			</li>
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				Poli
			</div>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
					<i class="fas fa-fw fa-clinic-medical"></i>
					<span>Poli</span>
				</a>
				<div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<!-- <a class="collapse-item" href="<?php echo base_url('daftar_poli');?>">Daftar Poli</a> -->
						<a class="collapse-item" href="<?php echo base_url('poli_umum');?>">Poli Umum</a>
						<a class="collapse-item" href="<?php echo base_url('poli_gizi');?>">Poli Gizi</a>
						<a class="collapse-item" href="<?php echo base_url('poli_gigi');?>">Poli Gigi</a>
					</div>
				</div>
			</li>
			<hr class="sidebar-divider">
			<!-- <div class="sidebar-heading">
				Dokter
			</div>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('dokter');?>">
					<i class="fas fa-user-md"></i>
					<span>Dokter</span>
				</a>
			</li>
			<hr class="sidebar-divider"> -->
			<div class="sidebar-heading">
				Pasien
			</div>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('pasien');?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Pasien</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('rekam_medis');?>">
					<i class="fas fa-fw fa-notes-medical"></i>
					<span>Rekam Medis</span>
				</a>
			</li>
			<!-- <li class="nav-item">
				<a class="nav-link" href="charts.html">
					<i class="fas fa-fw fa-arrow-right"></i>
					<span>Antrian</span>
				</a>
			</li> -->
			<hr class="sidebar-divider">
		</ul>
		<!-- Sidebar -->
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<!-- TopBar -->
				<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
					<button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-search fa-fw"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
								aria-labelledby="searchDropdown">
								<form class="navbar-search">
									<div class="input-group">
										<input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
											aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">
												<i class="fas fa-search fa-sm"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</li>
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-bell fa-fw"></i>
								<span class="badge badge-danger badge-counter">3+</span>
							</a>
							<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
								aria-labelledby="alertsDropdown">
								<h6 class="dropdown-header">
									Notifikasi
								</h6>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="mr-3">
										<div class="icon-circle bg-primary">
											<i class="fas fa-file-alt text-white"></i>
										</div>
									</div>
									<div>
										<div class="small text-gray-500">December 12, 2019</div>
										<span class="font-weight-bold">A new monthly report is ready to download!</span>
									</div>
								</a>
								<a class="dropdown-item text-center small text-gray-500" href="#">Tutup</a>
							</div>
						</li>
						<li class="nav-item dropdown no-arrow mx-1">
							<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
								aria-labelledby="messagesDropdown">
								<h6 class="dropdown-header">
									Message Center
								</h6>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="dropdown-list-image mr-3">
										<img class="rounded-circle" src="assets/img/man.png" style="max-width: 60px" alt="">
										<div class="status-indicator bg-success"></div>
									</div>
									<div class="font-weight-bold">
										<div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
											having.</div>
										<div class="small text-gray-500">Udin Cilok · 58m</div>
									</div>
								</a>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="dropdown-list-image mr-3">
										<img class="rounded-circle" src="assets/img/girl.png" style="max-width: 60px" alt="">
										<div class="status-indicator bg-default"></div>
									</div>
									<div>
										<div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
											say this to all dogs, even if they aren't good...</div>
										<div class="small text-gray-500">Jaenab · 2w</div>
									</div>
								</a>
								<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
							</div>
						</li>

						<div class="topbar-divider d-none d-sm-block"></div>
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								<img class="img-profile rounded-circle" src="assets/img/girl.png" style="max-width: 60px">
								<span class="ml-2 d-none d-lg-inline text-white small">Admin</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
									Activity Log
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>
					</ul>
				</nav>
				<!-- Topbar -->