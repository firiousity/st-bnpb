<body>
          <div class="container margin">
                  <div class="card mb-8">
                      <div class="card-body">
                          <p style="font-size: 27px;">Surat Detail</p>
                        <div align="center">
                        <table class="table table-hover">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">No Surat</th>
								<th scope="col">PRINT PDF</th>
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
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">SPD RAMPUNG
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/print_rincian/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">RINCIAN BIAYA
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/spd/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">SPD
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/hilang/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">BUKTI HILANG
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/lebih/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">SURAT LEBIH
                              </button></a></span>
                              <span><a href='".base_url('C_PDF/riil/'.$row->id_surat."_".$row->id_pegawai)."' target='_blank'> 
                              <button type=\"button\" class=\"btn btn-primary btn-rounded btn-sm my-0\">RIIL
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

</html>
