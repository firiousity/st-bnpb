<body>
  <div class="container margin">
        <p style="font-size: 27px; text-align: center;">Uang Representasi</p>
              <table id="uang_representasi" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th class="th-sm" scope="col">Uraian
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Luar Kota
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Dalam Kota
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Edit
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Hapus
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($representasi as $row) {
                              echo "
                            <tr>
                              <td>".$row->uraian."</td>
                              <td> Rp ".$row->luar_kota."</td>
                              <td> Rp ".$row->dalam_kota."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_representasi_page/$row->id")."'><button type='button'  class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                              </td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/delete_representasi/$row->id")."'><button type='button' class='btn btn-danger btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
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
            <div id="mapid" class="mapid">
              
            </div>
    </div>
  </div>

  <section>
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Uang Representasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('home/tambah_representasi') ?>" method="post">
            <div class="modal-body mx-5">
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="uraian">
                <label data-error="wrong" data-success="right">Uraian</label>
              </div>
              <div class="md-form mb-4">
                <input type="text" class="form-control" name="luar_kota">
                <label data-error="wrong" data-success="right">Luar Kota</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" class="form-control" name="dalam_kota">
                <label data-error="wrong" data-success="right">Dalam Kota</label>
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
<script>
$(document).ready(function () {
  $('#uang_representasi').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

  var mymap = L.map('mapid').setView([-6.192076, 106.869150], 15);

  L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYmFkbTRuIiwiYSI6ImNqa3Jvb3g4YjA3ZmgzcW1yazh2anBxd3QifQ.bpeA6asfyhBtKDTG4RGOOw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox.streets'
  }).addTo(mymap);

  L.marker([-6.171395, 106.90844]).addTo(mymap)
    .bindPopup("<b>Data Bantuan:</b><br />Makanan 1000").openPopup();

  var popup = L.popup();

  function onMapClick(e) {
    popup
      .setLatLng(e.latlng)
      .setContent("You clicked the map at " + e.latlng.toString())
      .openOn(mymap);
  }

  mymap.on('click', onMapClick);
</script>
</html>

