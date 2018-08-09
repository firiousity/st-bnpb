<body>
      <div class="container margin">
            <p style="font-size: 27px;">Surat Detail</p>
                  <table id="print_biaya" class="table table-hover" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th class="th-sm" scope="col">No
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Nomor Surat
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Nama
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
						  foreach ($nama as $row) {

						  	echo "
						  	<tr>
                              <th scope=\"row\">$i</th>
                              <td>$nomor</td>
                              <td>$row->nama_pegawai</td>
                              <td>
                              <span><a href='".base_url('C_PDF/form_biaya/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">PRINT BIAYA
                              </button></a></span>
                              
                              </td>
                            </tr>
						  	";
						  	$i++;
						  }
						  ?>
						  </tbody>
						</table>
                        <div class="row">

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
                    <div>
                        
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
