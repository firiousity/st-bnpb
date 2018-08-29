<nav class="navbar navbar-expand-lg animated fadeInDown navbar-dark indigo scrolling-navbar fixed-top">
  <div class="container">
    <a href="" class="navbar-brand"><img src="<?php echo base_url('assets/img/logo.png')?>" width="30" height="30"> 
    <a class="navbar-brand" href="<?php echo base_url('home/beranda')?>"><Strong>Persuratan Pusdatinmas</Strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-lg-0">
        </ul>
        <span>
            <ul class="navbar-nav navbar-right mr-auto mt-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="https://bnpb.go.id/">BNPB</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="http://dibi.bnpb.go.id/dibi/">DIBI</a>
            </li>
				<li class="nav-item">
                <a class="nav-link" onclick="keluar()">Logout</a>
            </li>
				<li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('home/ppk')?>"><i class="fa fa-gear"
					style="padding-top: 5px;"></i> </a>
            </li>
        </ul>    
        </span>
    </div>
</div>
</nav>
<script>
                      function keluar() {
                      const swalWithBootstrapButtons = swal.mixin({
                      confirmButtonClass: 'btn btn-success',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false,
                    })

                    swalWithBootstrapButtons({
                      title: 'Are you sure?',
                      text: "Recheck your work might help!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonText: 'Yes, im sure!',
                      cancelButtonText: 'No, cancel!',
                      reverseButtons: true
                    }).then((result) => {
                      if (result.value) {
                        window.location = '<?php echo base_url() ?>'
                      } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                      ) {
                        swalWithBootstrapButtons(
                          'Cancelled',
                          'Remember to never tired yourself out! :)',
                          'error'
                        )
                      }
                    })
                      }
          <?php if  (isset($_SESSION["berhasil"])) {?>

            swal({
              title: "Berhasil",
              text: "Thanks for your hardwork!",
              type: "success",
            });
          <?php } ?>
          <?php unset($_SESSION['berhasil']) ?>
                    </script>
