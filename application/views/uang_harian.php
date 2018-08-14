<body>
  <div class="container margin">
        <p style="font-size: 27px; text-align: center; padding-top: 50px;">Uang Harian</p>
          <table id="uang_harian" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th class="th-sm" scope="col">Provinsi
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Satuan
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Luar Kota
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Dalam Kota
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Diklat
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
                            <?php foreach ($harian as $row) {
                echo "
                <tr>
                              <td>".$row->provinsi."</td>
                              <td>OH</td>
                              <td> Rp ".$row->luar_kota."</td>
                              <td> Rp ".$row->dalam_kota."</td>
                              <td> Rp ". $row->diklat."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_harian_page/$row->id")."'><button type='button'  class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                              </td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/delete_harian/$row->id")."'><button type='button' class='btn btn-danger btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
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
            <h4 class="modal-title w-100 font-weight-bold">Uang Harian</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_harian') ?>" method="post">
            <div class="modal-body mx-5">
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="provinsi">
                <label data-error="wrong" data-success="right">Provinsi</label>
              </div>
              <div class="md-form mb-4">
                <!-- <i class="fa fa-address-card prefix grey-text"></i> -->
                <input type="text" class="form-control" name="luar_kota">
                <label data-error="wrong" data-success="right">Luar Kota</label>
              </div>

              <div class="md-form mb-4">
                <!-- <i class="fa fa-lock prefix grey-text"></i> -->
                <input type="text" class="form-control" name="dalam_kota">
                <label data-error="wrong" data-success="right">Dalam Kota</label>
              </div>

              <div class="md-form mb-4">
                <!-- <i class="fa fa-lock prefix grey-text"></i> -->
                <input type="text" class="form-control" name="diklat">
                <label data-error="wrong" data-success="right">Diklat</label>
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
  $('#uang_harian').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>

