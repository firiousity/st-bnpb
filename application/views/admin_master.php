<body>
  <div class="container" style="padding-top: 10vh; padding-bottom: 15vh">
        <p style="font-size: 27px; text-align: center; padding-top: 50px;">Kelola Admin</p>
        <table id="admin" class="table table-striped" cellspacing="0">
  <thead class="mdb-color darken-3 white-text">
    <tr>
      <th scope="col">No
        <i class="fa fa-sort float-right" aria-hidden="true"></i>
      </th>
      <th class="th-sm" scope="col">Username
        <i class="fa fa-sort float-right" aria-hidden="true"></i>
      </th>
      <th class="th-sm" scope="col">Password
        <i class="fa fa-sort float-right" aria-hidden="true"></i>
      </th>
      <th scope="col">Edit
        <i class="fa fa-sort float-right" aria-hidden="true"></i>
      </th>
      <th scope="col">Hapus
        <i class="fa fa-sort float-right" aria-hidden="true"></i>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php $counter = 1;
    foreach ($admin as $row) {
                echo "
                  <tr>
                  <td>".$counter."</td>
                  <td>".$row->nama."</td>
                  <td>".$row->password."</td>
                  <td>
                    <span class='table-remove'><a href='".base_url("home/edit_admin_page/$row->id")."'><button type='button'  class='btn btn-warning  btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                  </td>
                  <td>
                  <span class='table-remove'><button onclick='hapus($row->id)' type='button' class='btn btn-danger btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
                  </td>
                    </tr>";
                     $counter++;}
                     ?>
  </tbody>
</table>
                    <script>
                      function hapus(id) {
                      const swalWithBootstrapButtons = swal.mixin({
                      confirmButtonClass: 'btn btn-success',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false,
                    })

                    swalWithBootstrapButtons({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonText: 'Yes, delete it!',
                      cancelButtonText: 'No, cancel!',
                      reverseButtons: true
                    }).then((result) => {
                      if (result.value) {
                        window.location = '<?php echo base_url() ?>home/delete_admin/'+id;
                      } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                      ) {
                        swalWithBootstrapButtons(
                          'Cancelled',
                          'Your imaginary file is safe :)',
                          'error'
                        )
                      }
                    })
                      }
          <?php if  (isset($_SESSION["berhasil"])) {?>

            swal({
              title: "Berhasil",
              text: "Data berhasil dihapus",
              type: "success",
            });
          <?php } ?>
          <?php unset($_SESSION['berhasil']) ?>
                    </script>
              <!-- <div align="center">
                <a href="#"><button type="button" data-toggle="modal" data-target="#modalRegisterForm" class="btn btn-indigo btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Pegawai</button></a>
              </div> -->
              
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="btn-group">
        <a href="#"> <button class="btn animated bounceInLeft btn-indigo btn-fab" type="button" data-toggle="modal" data-target="#modalRegisterForm" id="main"><i class="fa fa-plus" aria-hidden="true">
          </i> Tambah</button> 
        </a>
      </div>
    </div>
  </div>
</div>
      </div>
    </div>
  </div>
  <section>
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Tambah Admin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_admin') ?>" method="post">
            <div class="modal-body mx-5">
              <div class="md-form mb-4">
                <!-- <i class="fa fa-user prefix grey-text"></i> -->
                <input type="text" class="form-control" name="nama">
                <label data-error="wrong" data-success="right">Username</label>
              </div>
              <div class="md-form mb-4">
                <!-- <i class="fa fa-address-card prefix grey-text"></i> -->
                <input type="text" class="form-control" name="password">
                <label data-error="wrong" data-success="right">Password</label>
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
</body>
<script>
$(document).ready(function () {
  $('#admin').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
$("#main").click(function() {
  $("#mini-fab").toggleClass('hidden');
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
});
$.material.init();
</script>
