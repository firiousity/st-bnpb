<body>
  <div class="container-fluid" style="padding-top: 10vh;">
    <div class="row">
      <div class="col"> 
        <p style="font-size: 27px; text-align: center; padding-top: 50px;">Dasar Hukum</p>
            <table class="table" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No
                                <i aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Hukum
                                <i aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" sscope="col">Edit
                                <i aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $counter = 1;
                            foreach ($hukum as $row) {
                echo "
                <tr>
                              <td>".$counter."</td>
                              <td>".$row->hukum."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_hukum_page/$row->id")."'><button type='button'  class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                              </td>
                            </tr>
                            ";
              $counter++;}
                             ?>
                      </tbody>
                    </table>
      </div>

<!-- Tabel Pos Kegiatan -->
      <div class="col">
        <p style="font-size: 27px; text-align: center; padding-top: 50px;">Pos Kegiatan</p>
            <table class="table" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No
                                <i aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Pos Kegiatan
                                <i aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" sscope="col">Edit
                                <i aria-hidden="true"></i>
                              </th>
                              <th scope="col">Delete
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $counter = 1;
                            foreach ($pos_kegiatan as $row) {
                echo "
                <tr>
                              <td>".$counter."</td>
                              <td>".$row->kegiatan."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_kegiatan_page/$row->id")."'><button type='button'  class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                              </td>
                              <td>
                                 <span class='table-remove'><button onclick='delete_kegiatan($row->id)' type='button' class='btn btn-danger btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
                              </td>
                            </tr>
                            ";
              $counter++;}
                             ?>
                      </tbody>
                    </table>
                    <tfoot>
  <div class="row">
    <div class="col" align="right">
      <div class="btn-group">
        <a href="#"> <button class="btn animated zoomInUp btn-indigo" type="button" data-toggle="modal" data-target="#modalRegisterForm2" id="main"><i class="fa fa-plus" aria-hidden="true">
          </i> Tambah</button> 
        </a>
      </div>
    </div>
  </div>
                    </tfoot>

<!-- Modal Tambah Kegiatan -->
      <section>
    <div class="modal fade" id="modalRegisterForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Dasar Hukum</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_kegiatan') ?>" method="post">
            <div class="modal-body mx-5">
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="kegiatan">
                <label data-error="wrong" data-success="right">Kegiatan</label>
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

                    <!-- Swal Delete Kegiatan -->
                    <script>
                      function delete_kegiatan(id) {
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
                        window.location = '<?php echo base_url() ?>home/delete_kegiatan/'+id;
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
      </div>
    </div>
  </div>
</body>
<script>
$(document).ready(function () {
  $('#pejabat').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>

