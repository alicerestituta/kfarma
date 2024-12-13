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
						<!-- <a class="collapse-item" href="<?php echo base_url('daftar_poli'); ?>">Daftar Poli</a> -->
						<a class="collapse-item" href="<?php echo base_url('poli_umum'); ?>">Poli Umum</a>
						<a class="collapse-item" href="<?php echo base_url('poli_gizi'); ?>">Poli Gizi</a>
						<a class="collapse-item" href="<?php echo base_url('poli_gigi'); ?>">Poli Gigi</a>
					</div>
				</div>
			</li>
			<hr class="sidebar-divider">
			<!-- <div class="sidebar-heading">
				Dokter
			</div>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('dokter'); ?>">
					<i class="fas fa-user-md"></i>
					<span>Dokter</span>
				</a>
			</li>
			<hr class="sidebar-divider"> -->
			<div class="sidebar-heading">
				Pasien
			</div>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('pasien'); ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Pasien</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('rekam_medis'); ?>">
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
				</nav>
				<!-- Topbar -->
