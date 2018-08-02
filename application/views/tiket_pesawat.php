<body>
  <div class="container margin">
    <div class="card mb-8">
      <div class="card-body">
        <p style="font-size: 27px;">Tiket Pesawat</p>
        <div align="center">
          <table class="table table-hover">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">Kota</th>
                              <th scope="col">Harga Tiket</th>
                              <th scope="col">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($pesawat as $row) {
                echo "
                <tr>
                              <td>".$row->kota."</td>
                              <td> Rp ".$row->biaya_tiket."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_tiket_page/$row->id")."'><button type='button'  class='btn btn-danger btn-rounded btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                                <span class='table-remove'><a href='".base_url("home/delete_tiket/$row->id")."'><button type='button' class='btn btn-danger btn-rounded btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
                                </td>
                            </tr>
                            <tr>";
              }
                             ?>
                      </tbody>
                    </table>
          <div class="row">
            <div class="col">
              <div align="left">
                <a href="#"><button type="button" data-toggle="modal" data-target="#modalRegisterForm" class="btn btn-indigo btn-md">Tambah</button></a>
              </div>
            </div>
            <div class="col">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                  <!--Previous-->
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  <!--Numbers-->
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <!--Next-->
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
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
            <h4 class="modal-title w-100 font-weight-bold">Tambah Pegawai</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_pegawai') ?>" method="post">
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
          <form action="<?php  echo base_url('home/edit_pegawai/')?>" method="post">
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
</body>

</html>

