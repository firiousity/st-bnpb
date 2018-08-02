<body>
        <div class="container" style="margin: 5%;">
                <div class="card mb-8">

                    <div class="card-body">
                        <p style="font-size: 27px;">Surat</p>
                        <div align="center">
                        <table class="table table-hover">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nomor Surat</th>
                              <th scope="col">Tempat</th>
                              <th scope="col">PDF</th>
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
                              <td><span class=\"table-remove\"><a href='".base_url('C_PDF/print/'.$row->id)."' target='_blank'> <button type=\"button\" class=\"btn btn-danger btn-rounded btn-sm my-0\">PRINT</button></a></span></td>
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
