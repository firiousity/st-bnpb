<body>
  <div class="container margin">
        <p style="font-size: 27px; text-align: center; padding-top: 50px;">Biaya Transport</p>
          <table id="biaya_transport" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th class="th-sm" scope="col">Provinsi
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Satuan
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Besaran
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
                            <?php foreach ($transport as $row) {
                echo "
                <tr>
                              <td>".$row->provinsi."</td>
                              <td>Orang/Kali</td>
                              <td> Rp ".$row->besaran."</td>
                              
                              <td>
                                 <span class='table-remove'><a href='".base_url("home/edit_transport_page/$row->id")."'><button type='button'  class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                              </td>
                              <td>
                                 <span class='table-remove'><a href='".base_url("home/delete_transport/$row->id")."'><button type='button' class='btn btn-danger btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
                              </td>
                            </tr>
                            ";
              }
                             ?>
                      </tbody>
                    </table>
              <div align="left">
                <a href="#"><button type="button" data-toggle="modal" data-target="#modalRegisterForm" class="btn btn-indigo btn-md">Tambah</button></a>
              </div>
    </div>
  </div>

  <section>
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Biaya Transport</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_transport') ?>" method="post">
            <div class="modal-body mx-5">
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="provinsi">
                <label data-error="wrong" data-success="right">Provinsi</label>
              </div>
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="besaran">
                <label data-error="wrong" data-success="right" for="orangeForm-email">Besaran</label>
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
  $('#biaya_transport').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>

