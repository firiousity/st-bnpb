<?php

?>
<body>
	<div class="container margin">
		<div class="card mb-6">
			<h1>
				<?php  ?>
			</h1>
			<!-- Default form contact -->
			<form class="needs-validation" novalidate style="margin: 1%" action="<?php echo base_url('C_PDF/print_rampung/'.$slug) ?>" method="post">
				<h2 class="judul">ISIAN FORM RAMPUNG</h2>
					<input id="isReimburse" type="checkbox" class="custom-checkbox" >Reimburse
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="validationCustom01">Uang Harian</label>
						<input type="number" class="form-control" name="harian" id="validationCustom01" placeholder="Rp. "
							   required  autofocus>
					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Uang Penginapan</label>
						<input type="number" class="form-control" id="validationCustom02" name="penginapan"
							   placeholder="Rp. " required>

					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom01">Uang Transport</label>
						<input type="number" class="form-control" name="transport" id="validationCustom01" placeholder="Rp. "
							   required  autofocus>
					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Tiket Pesawat</label>
						<input type="number" class="form-control" id="validationCustom02" name="tiket"
							   placeholder="Rp. " required>

					</div>
				</div>

				<h2 class="judul">UANG YANG SUDAH DIBAYAR</h2>
				<div class="form-row" id="sudahbayar">
					<div class="col-md-4 mb-3">
						<label for="validationCustom01">Uang Harian</label>
						<input type="number" class="form-control" name="s_harian" id="s_harian" placeholder="Rp. "
							   required  value="0">
					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Uang Penginapan</label>
						<input type="number" class="form-control" id="s_penginapan" name="s_penginapan"
							   placeholder="Rp. " required value="0">

					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom01">Uang Transport</label>
						<input type="number" class="form-control" name="s_transport" id="s_transport" placeholder="Rp. "
							   required  autofocus value="0">
					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Tiket Pesawat</label>
						<input type="number" class="form-control" id="s_tiket" name="s_tiket"
							   placeholder="Rp. " value="0" required>

					</div>
				</div>

				<button class="btn btn-indigo" type="submit">Print Surat</button>
			</form>
		</div>

	</div>
</body>
<script type="text/javascript">
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	$('#my-select').multiSelect();
	$('#my-select-tiket').multiSelect();
	$('#my-select-harian').multiSelect();
	$('#my-select-penginapan').multiSelect();
	$('#my-select-transport').multiSelect();

	$(document).ready(function(){
		$('#isReimburse').change(function(){
			var checked = $(this).attr('checked');
			if (checked) {
				$('#sudahbayar').show();
			} else {
				$('#sudahbayar').hide();
			}
		});
	});

</script>

