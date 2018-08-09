<body>
          <div class="container margin">
                <p style="font-size: 27px; text-align: center;">Surat</p>
                      <table id="lihat_surat" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th class="th-sm" scope="col">No.
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Nomor Surat
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Tempat
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">PDF
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
                              <td>$row->tempat</td>
                              <td>
                              <span><a href='".base_url('C_PDF/print/'.$row->id)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">PRINT SURAT DINAS
                              </button></a></span>
                              <a href='".base_url('C_PDF/print_biaya/'.$row->id)."'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">LIHAT RINCIAN BIAYA
                              </button></a>
                              
                              </td>
                            </tr>
						  	";
						  	$i++;
						  }
						  ?>
						  </tbody>
						</table>
                    <div align="left">
                          <a href="<?php  echo base_url('home/buat_surat')?>"><button type="button" class="btn btn-indigo btn-md">Tambah Surat</button></a>
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
