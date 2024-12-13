<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/ruang-admin.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<!-- <script src="assets/js/demo/chart-area-demo.js"></script> -->
<!-- <script src="assets/js/demo/chart-bar-demo.js"></script> -->
<!-- <script src="assets/js/demo/dashboard-chart.js"></script> -->
<script type="text/javascript" src="chrome-extension://fpjppnhnpnknbenelmbnidjbolhandnf/content_script_web_accessible/ecp_regular.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div id="extension-mmplj"></div>
<script>var base_url = '<?php echo base_url(); ?>';</script>
<?php if (isset($js)) { ?>
	<script src="<?php echo base_url('app/' . $js . '.js'); ?>"></script>
<?php } ?>
</body>

</html>
