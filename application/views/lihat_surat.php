<body>
          <div class="container" style="padding-top: 10%;">
                <p style="font-size: 27px; text-align: center;">Daftar Surat</p>
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
                              <th class="th-sm" scope="col">Hapus
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
                              <td>
                                <span class='table-remove'><button onclick='hapus($row->id)' type='button' class='btn btn-danger btn-sm my-0'><i class='fa fa-times' aria-hidden='true'></i></button></span>
                                </td>
                            </tr>
    						  	";
    						  $i++;
    						}
    				  ?>
						  </tbody>
						</table>
<script>
                      function hapus(id) {
                      const swalWithBootstrapButtons = swal.mixin({
                      confirmButtonClass: 'btn btn-success',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false,
                    })

                    swalWithBootstrapButtons({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonText: 'Yes, delete it!',
                      cancelButtonText: 'No, cancel!',
                      reverseButtons: true
                    }).then((result) => {
                      if (result.value) {
                        window.location = '<?php echo base_url() ?>home/delete_surat/'+id;
                      } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                      ) {
                        swalWithBootstrapButtons(
                          'Cancelled',
                          'Your imaginary file is safe :)',
                          'error'
                        )
                      }
                    })
                      }
                    </script>


<div class="container-fluid">
      <div class="btn-group">
        <a href="<?php  echo base_url('surat/buat_surat_dinas')?>"> <button class="btn animated bounceInLeft btn-indigo btn-fab" type="button" data-toggle="modal" data-target="#modalRegisterForm" id="main"><i class="fa fa-plus" aria-hidden="true">
          </i> Tambah</button> 
        </a>
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
$("#main").click(function() {
  $("#mini-fab").toggleClass('hidden');
});
</script>
</html>
