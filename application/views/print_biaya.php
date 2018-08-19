<body>
          <div class="container margin">
                <p style="font-size: 27px; text-align: center; padding-top: 50px;">Detail Surat</p>
                      <table id="print_biaya" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No.
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Nama
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Print Surat
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
						  <?php
						  $i = 1;
						  foreach ($nama as $row) {


						  	echo "
						  	<tr>
                              <th scope=\"row\">$i</th>
                              <td>$row->nama_pegawai</td>
                              <td>
                              
                              <span><a href='".base_url('C_PDF/rampung/'.$row->id_surat."_".$row->id_pegawai)."'> 
                              <button type=\"button\" class=\"btn btn-light-blue btn-sm my-0\">SPD RAMPUNG
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/print_rincian/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-sm my-0\">RINCIAN BIAYA
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/spd/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-indigo btn-sm my-0\">SPD
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/hilang/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-deep-purple btn-rounded btn-sm my-0\">BUKTI HILANG
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/lebih/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-mdb-color btn-rounded btn-sm my-0\">SURAT LEBIH
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/riil/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-blue-grey btn-rounded btn-sm my-0\">RIIL
                              </button></a></span>
                              </td>
                            </tr>
						  	";
						  	$i++;
						  }
						  ?>
						  </tbody>
						</table>
            <a href="<?php echo base_url('home/lihat_surat')?>"><button class="btn btn-indigo"><i class="fa fa-angle-left" aria-hidden="true"></i> Kembali</button></a>
            </div>

        </div>

</body>
<script>
$(document).ready(function () {
  $('#print_biaya').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>
