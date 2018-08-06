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
								<th scope="col">Nama</th>
                              <th scope="col">PDF</th>
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
                              <span><a href='".base_url('C_PDF/form_biaya/'.$row->id_pegawai)."' target='_blank'> 
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
                                <div align="left">
                                    <a href="<?php  echo base_url('home/buat_surat')?>"><button type="button" class="btn btn-indigo btn-md">Tambah Surat</button></a>
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
                    <div>
                        
                    </div>
                </div>
              </div>
          </div>

</body>

</html>
