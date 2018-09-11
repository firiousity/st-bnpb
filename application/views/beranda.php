<body style="background-color: #eceff1">
<!-- Card deck -->
<div class="container center">
<div class="card-deck">

  <!-- Card -->
  <div class="card mb-12 animated zoomInLeft">

    <!--Card image-->
    <div class="view zoom">
      <img class="card-img-top" src="<?php echo base_url('assets/img/surat.jpg')?>" alt="Card image cap">
        <div class="mask flex-center"></div>
    </div>

    <!--Card content-->
    <div class="card-body">
      <!--Title-->
      <h4 class="card-title jdl">Persuratan</h4>
      <!--Text-->
      <p class="card-text">Lihat daftar surat atau buat surat baru</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
		<div class="dropdown">
			<button id="surat" data-target="#" href="https://example.com"
					class="btn btn-indigo btn-md dropdown-toggle dropena" type="button"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
			<div class="dropdown-menu" aria-labelledby="surat">
				<a class="dropdown-item" href="<?php echo base_url('surat/buat_surat_dinas')?>">Buat Surat</a>
				<a class="dropdown-item" href="<?php echo base_url('home/lihat_surat')?>">Daftar Surat</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo base_url('home/hukum')?>">Lainnya</a>
			</div>
		</div>
    </div>
  </div>
  <div class="card mb-12 animated zoomInUp">

    <!--Card image-->
    <div class="view zoom">
      <img class="card-img-top" src="<?php echo base_url('assets/img/anggaran.jpg')?>" alt="Card image cap">
        <div class="mask flex-center"></div>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">Anggaran</h4>
      <!--Text-->
      <p class="card-text">Mengelola anggaran SBU Pusdatinmas</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <div class="dropup">
    <button id="anggaran" data-target="#" class="btn btn-indigo btn-md dropdown-toggle dropena" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pilih
    </button>
    <div class="dropdown-menu" aria-labelledby="anggaran">
        <a class="dropdown-item" href="<?php echo base_url('home/biaya_penginapan')?>">Biaya Penginapan</a>
        <a class="dropdown-item" href="<?php echo base_url('home/biaya_transport')?>">Biaya Transport</a>
        <a class="dropdown-item" href="<?php echo base_url('home/uang_harian')?>">Uang Harian</a>
        <a class="dropdown-item" href="<?php echo base_url('home/uang_representasi')?>">Uang Representasi</a>
        <a class="dropdown-item" href="<?php echo base_url('home/tiket_pesawat')?>">Tiket Pesawat</a>
        <a class="dropdown-item" href="<?php echo base_url('home/transport_lokal')?>">Transport Lokal</a>
    </div>
</div>

    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-12 animated zoomInRight">

    <!--Card image-->
    <div class="view zoom">
      <img class="card-img-top" src="https://www.menpan.go.id/site/images/berita_foto/20180222_BNPB_di_Bali_3.jpeg" alt="Card image cap">
        <div class="mask flex-center"></div>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">Kepegawaian</h4>
      <!--Text-->
      <p class="card-text">Data pegawai Pusdatinmas BNPB</p>
      <div class="dropdown">
        <button id="pegawai" data-target="#" class="btn btn-indigo btn-md dropdown-toggle dropena" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Kelola
        </button>
        <div class="dropdown-menu" aria-labelledby="pegawai">
          <a class="dropdown-item" href="<?php echo base_url('home/pegawai')?>">Daftar Pegawai</a>
          <a class="dropdown-item" href="<?php echo base_url('home/ppk')?>">Pejabat Pembuat Komitmen</a>
        </div>
      </div>
    </div>

  </div>
  <!-- Card -->

</div>
</div>
<!-- Card deck -->

<script>
$(document).ready(function(){
    $('.dropdown-toggle').dropdown();
});
</script>

          <?php if (isset($_SESSION['success'])): ?>
            <script>
              swal({
              title: "<?php echo $_SESSION['success'][0] ?>",
              text: "<?php echo $_SESSION['success'][1] ?>",
              type: "success",
          });
            </script>
        <?php unset($_SESSION['success']) ?>
          <?php endif ?>
</body>



</html>
