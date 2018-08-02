<?php
/**
 * Created by PhpStorm.
 * User: MNurilmanBaehaqi
 * Date: 7/31/2018
 * Time: 11:25 AM
 */

?>
<section>
	<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">

			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Tambah Pegawai</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php  base_url('home/ena')?>" method="post">
					<div class="modal-body mx-5">
						<div class="md-form mb-4">
							<!-- <i class="fa fa-user prefix grey-text"></i> -->
							<input type="text" id="orangeForm-name" class="form-control validate" name="nama">
							<label data-error="wrong" data-success="right" for="orangeForm-name">Nama Lengkap</label>
						</div>
						<div class="md-form mb-4">
							<!-- <i class="fa fa-address-card prefix grey-text"></i> -->
							<input type="text" id="orangeForm-email" class="form-control validate" name="nip">
							<label data-error="wrong" data-success="right" for="orangeForm-email">NIP</label>
						</div>

						<div class="md-form mb-4">
							<!-- <i class="fa fa-lock prefix grey-text"></i> -->
							<input type="text" id="orangeForm-pass" class="form-control validate" name="jabatan">
							<label data-error="wrong" data-success="right" for="orangeForm-pass">Jabatan</label>
						</div>

						<div class="md-form mb-4">
							<!-- <i class="fa fa-lock prefix grey-text"></i> -->
							<input type="text" id="orangeForm-pass" class="form-control validate" name="gol">
							<label data-error="wrong" data-success="right" for="orangeForm-pass">Golongan</label>
						</div>
					</div>
					<div class="modal-footer d-flex justify-content-center">
						<button class="btn btn-indigo" type="submit">Tambah</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</section>

<section>
	<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Edit Pegawai</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post">
					<div class="modal-body mx-5">
						<div class="md-form mb-4">
							<!-- <i class="fa fa-user prefix grey-text"></i> -->
							<input type="text" id="orangeForm-name" class="form-control validate" name="nama">
							<label data-error="wrong" data-success="right" for="orangeForm-name">Nama Lengkap</label>
						</div>
						<div class="md-form mb-4">
							<!-- <i class="fa fa-address-card prefix grey-text"></i> -->
							<input type="text" id="orangeForm-email" class="form-control validate" name="nip">
							<label data-error="wrong" data-success="right" for="orangeForm-email">NIP</label>
						</div>

						<div class="md-form mb-4">
							<!-- <i class="fa fa-lock prefix grey-text"></i> -->
							<input type="text" id="orangeForm-pass" class="form-control validate" name="jabatan">
							<label data-error="wrong" data-success="right" for="orangeForm-pass">Jabatan</label>
						</div>

						<div class="md-form mb-4">
							<!-- <i class="fa fa-lock prefix grey-text"></i> -->
							<input type="text" id="orangeForm-pass" class="form-control validate" name="gol">
							<label data-error="wrong" data-success="right" for="orangeForm-pass">Golongan</label>
						</div>

					</div>
					<div class="modal-footer d-flex justify-content-center">
						<button class="btn btn-indigo">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>




