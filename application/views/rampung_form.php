<?php

?>
<body>
	<div class="container margin">
		<div class="card mb-6">
			<h1>
				<?php  ?>
			</h1>
			<!-- Default form contact -->
			<form class="needs-validation"  style="margin: 1%"
				  action="<?php echo base_url('C_PDF/print_rampung/'.$slug) ?>"
				  method="post">
				<h2 class="judul">ISIAN FORM RAMPUNG</h2>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Uang Penginapan</label>
						<input type="number" class="form-control" id="validationCustom02" required name="penginapan"
							   placeholder="Rp. " required>

					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Tiket Pesawat</label>
						<input type="number" class="form-control" id="validationCustom02" required name="tiket"
							   placeholder="Rp. " required>

					</div>
				</div></div>

				<button class="btn btn-indigo" type="submit">Print Surat</button>
			</form>
		</div>

	</div>
</body>

