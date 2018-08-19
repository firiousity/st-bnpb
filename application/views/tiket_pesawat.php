<body>
  <div class="container margin">
        <p style="font-size: 27px; text-align: center; padding-top: 50px;">Tiket Pesawat</p>
                  <table id="tiket_pesawat" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th class="th-sm" scope="col">No
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Rute
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Harga Tiket
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Edit
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Delete
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $counter = 1;
                            foreach ($pesawat as $row) {
                              echo "
                              <tr>
                              <td>".$counter."</td>
                              <td>".$row->rute."</td>
                              <td> Rp ".$row->biaya_tiket."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_tiket_page/$row->id")."'><button type='button' class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></span>
                              </td>
                              <td>
                                <span class='table-remove'><button onclick='hapus($row->id)' type='button' class='btn btn-danger btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
                              </td>
                            </tr>
                            ";
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
                        window.location = '<?php echo base_url() ?>home/delete_tiket/'+id;
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
                    </script>
              <div align="center">
                <a href="#"><button type="button" data-toggle="modal" data-target="#modalRegisterForm" class="btn btn-indigo btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button></a>
              </div>
      </div>
    </div>
  </div>

  <section>
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Tiket Pesawat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_tiket') ?>" method="post">
            <div class="modal-body mx-5">
              <div class="md-form mb-4">
                <input type="text" class="form-control" required="true" name="rute">
                <label data-error="wrong" data-success="right">Kota asal - Kota tujuan</label>
              </div>
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="biaya_tiket">
                <label data-error="wrong" data-success="right">Harga Tiket</label>
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
  $('#tiket_pesawat').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>

