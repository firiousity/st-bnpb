<body>
<!-- Intro Section -->
<div class="view hm-black-light jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url('<?php echo base_url()."assets/img/2.jpg";?>');height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; ">
	<div class="full-bg-img">
		<div class="container flex-center">
			<div class="row pt-5 mt-3">
				<div class="col-md-12">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Card deck -->
<div class="container" style="position: fixed; top: 45%; left: 50%; transform: translateX(-50%) translateY(-50%);">
<div class="card-deck">

  <!-- Card -->
  <div class="card mb-12"  style="margin-top: 0px;">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/16.jpg" alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">Lihat Surat</h4>
      <!--Text-->
      <p class="card-text">Some quick example text</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <a href="lihat_surat"><button type="button" class="btn btn-indigo btn-md">Lihat</button></a>

    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-12">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/14.jpg" alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">Buat Surat</h4>
      <!--Text-->
      <p class="card-text">Some quick example text</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
		  <a href="buat_surat"><button type="button" class="btn btn-indigo btn-md">Buat</button></a>

    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-12">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/15.jpg" alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">Anggaran</h4>
      <!--Text-->
      <p class="card-text">Mengelola anggaran</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <div class="btn-group">
    <button id="anggaran" data-target="#" href="https://example.com" class="btn btn-indigo btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pilih
    </button>
    <div class="dropdown-menu" aria-labelledby="anggaran">
        <a class="dropdown-item" href="biaya_penginapan">Biaya Penginapan</a>
        <a class="dropdown-item" href="biaya_transport">Biaya Transport</a>
        <a class="dropdown-item" href="uang_harian">Uang Harian</a>
        <a class="dropdown-item" href="uang_representasi">Uang Representasi</a>
        <a class="dropdown-item" href="tiket_pesawat">Tiket Pesawat</a>

    </div>
</div>
      <!-- <a href="akun"><button type="button" class="btn btn-indigo btn-md">kelola</button></a> -->

    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-12">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/15.jpg" alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">Pegawai</h4>
      <!--Text-->
      <p class="card-text">Mengelola data kepegawaian</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <a href="pegawai"><button type="button" class="btn btn-indigo btn-md">kelola</button></a>

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
</body>



</html>
