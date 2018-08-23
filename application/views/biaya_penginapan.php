<body>
  <div class="container-fluid" style="padding-top: 20vh; padding-bottom: 20vh">
        <p style="font-size: 27px; text-align: center;">Biaya Penginapan</p>
            <table id="biaya_penginapan" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Provinsi
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Eselon I
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Eselon II
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Eselon III
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Eselon IV
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Eselon Golongan I/II
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
                            foreach ($penginapan as $row) {
                echo "
                <tr>
                              <td>".$counter."</td>
                              <td>".$row->provinsi."</td>
                              <td> Rp ".$row->eselon_1."</td>
                              <td> Rp ".$row->eselon_2."</td>
                              <td> Rp ".$row->eselon_3."</td>
                              <td> Rp ".$row->eselon_4."</td>
                              <td> Rp ".$row->eselon_5."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_penginapan_page/$row->id")."'><button type='button'  class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
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
                        window.location = '<?php echo base_url() ?>home/delete_penginapan/'+id;
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

  <section>
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Biaya Penginapan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_penginapan') ?>" method="post">
            <div class="modal-body mx-5">
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="provinsi">
                <label data-error="wrong" data-success="right">Provinsi</label>
              </div>
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="eselon_1">
                <label data-error="wrong" data-success="right">Eselon I</label>
              </div>

              <div class="md-form mb-4">
                <input type="text"class="form-control" name="eselon_2">
                <label data-error="wrong" data-success="right">Eselon 2</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" class="form-control" name="eselon_3">
                <label data-error="wrong" data-success="right">Eselon 3</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" class="form-control" name="eselon_4">
                <label data-error="wrong" data-success="right">Eselon 4</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" class="form-control" name="eselon_5">
                <label data-error="wrong" data-success="right">Golongan I/II</label>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button onclick="tambah($row->id)" class="btn btn-indigo" type="submit">Tambah</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>

</body>
<script>
$(document).ready(function () {
  $('#biaya_penginapan').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>

