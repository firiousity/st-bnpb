<body>
          <div class="container">
                <p style="font-size: 27px; text-align: center; padding-top: 20vh;">Daftar Surat</p>
                      <table id="lihat_surat" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No.
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Nomor Surat
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Kegiatan
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Rincian Biaya
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Print
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
						  <?php
						  $i = 1;
						  foreach ($surat as $row) {

						  	echo "
						  	<tr>
                              <th scope=\"row\">$i</th>
                              <td>$row->nomor</td>
                              <td>$row->kegiatan</td>
                              <td>
                              <a href='".base_url('C_PDF/print_biaya/'.$row->id)."'> 
                              <button type=\"button\" class=\"btn btn-success btn-sm my-0\">LIHAT RINCIAN
                              </button></a>
                              </td>
                              <td>
                              <a href='".base_url('C_PDF/print/'.$row->id)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-success btn-sm my-0\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i> PRINT SURAT
                              </button></a>
                              </td>
                            </tr>
						  	";
						  	$i++;
						  }
						  ?>
						  </tbody>
						</table>
                   <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="btn-group">
        <a href="#"> <button class="btn btn-indigo btn-fab" type="button" data-toggle="modal" data-target="#modalRegisterForm" id="main"><i class="fa fa-plus" aria-hidden="true">
          </i> Tambah</button> 
        </a>
      </div>
    </div>
  </div>
</div>
              </div>
          </div>
        </div>

</body>
<script>
$(document).ready(function () {
  $('#lihat_surat').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>
