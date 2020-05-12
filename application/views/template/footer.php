<footer>

	<strong> <a href="#"></a></strong>
	<script type="application/javascript">
		function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
			try {
				decimalCount = Math.abs(decimalCount);
				decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

				const negativeSign = amount < 0 ? "-" : "";

				let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
				let j = (i.length > 3) ? i.length % 3 : 0;

				return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands);
			} catch (e) {
				console.log(e)
			}
		};

	</script>

	<!-- jQuery 3 -->
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
        $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Morris.js charts -->
	<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
	<script>
       /* window.load =function() {
            $('.preloader').fadeOut("slow")

        };*/
	</script>
	<!-- Datatables -->
	<script src="<?php echo base_url(); ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/jszip/dist/jszip.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
	<script>
		$(document).ready( function () {
			//$('#datatable-buttons').DataTable();
		} );

		function init_DataTables() {
			if (console.log("run_datatables"), "undefined" != typeof $.fn.DataTable) {
				console.log("init_DataTables");
				var a = function () {
					$("#datatable-buttons").length && $("#datatable-buttons").DataTable({
						dom: "Blfrtip",
						buttons: [{extend: "copy", className: "btn-sm"}, {extend: "csv", className: "btn-sm"}, {
							extend: "excel",
							className: "btn-sm"
						}, {extend: "pdfHtml5", className: "btn-sm"}, {extend: "print", className: "btn-sm"}],
						responsive: !0
					})
				};
				TableManageButtons = function () {
					"use strict";
					return {
						init: function () {
							a()
						}
					}
				}(), $("#datatable").dataTable(), $("#datatable-keytable").DataTable({keys: !0}), $("#datatable-responsive").DataTable(), $("#datatable-scroller").DataTable({
					ajax: "js/datatables/json/scroller-demo.json",
					deferRender: !0,
					scrollY: 380,
					scrollCollapse: !0,
					scroller: !0
				}), $("#datatable-fixed-header").DataTable({fixedHeader: !0});
				var b = $("#datatable-checkbox");
				b.dataTable({order: [[1, "asc"]], columnDefs: [{orderable: !1, targets: [0]}]}), b.on("draw.dt", function () {
					$("checkbox input").iCheck({checkboxClass: "icheckbox_flat-green"})
				}), TableManageButtons.init()
			}
		}
	</script>
</footer>
</body>
</html>
