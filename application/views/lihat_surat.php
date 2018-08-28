<body>
          <div class="container-fluid" style="padding-top: 10vh; padding-bottom: 15vh;">
                <p style="font-size: 27px; text-align: center; padding-top: 50px;">Daftar Surat</p>
                      <table id="lihat_surat" class="table table-striped" cellspacing="0">
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
                              <th class="th-sm" scope="col">Opsi
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
						  <?php
						  $i = 1;
						  foreach ($surat as $row) {
							  $nomor = $row->nomor;
							  $arr_nomor = explode('/', $nomor);
							  $nomor_surat = trim($arr_nomor[0], " ");
						  	echo "
						  	<tr>
                              <th scope=\"row\">$i</th>
                              <td>$row->nomor</td>
                              <td>$row->kegiatan</td>
                              <td>
                                <a href='".base_url('C_PDF/print_biaya/'.$row->id)."'> 
                                <button type=\"button\" class=\"btn btn-indigo btn-sm my-0\">LIHAT RINCIAN
                                </button></a>
                              </td>
                              <td>
                                <a href='".base_url('C_PDF/print/'.$row->id)."' target='_blank'> 
                                <button type=\"button\" class=\"btn btn-indigo btn-sm my-0\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i> PRINT SURAT
                                </button></a>
                              </td>
                              <td>
                                <button onclick='hapus($row->id)' 
                                type='button' class='btn btn-danger btn-sm my-0'>
                                <i class='fa fa-times' aria-hidden='true'></i></button>
                                
    						  	";
						  	//edit button hanya muncul kalo nomornya belum ada
						  if(empty($nomor_surat)) {
							  echo "
                                <span><a  data-toggle='modal' 
                                data-target='#modalEdit'><button
                                type='button' class='btn btn-warning btn-sm my-0' id='edit_surat'>
                                <i class='fa fa-edit' aria-hidden='true'></i></button></span>
                                </td>
                            </tr>";
						  }


    						  $i++;
    						}
    				  ?>
						  </tbody>
						</table>
			  <script>

				  if(<?php echo empty($nomor_surat) ?>) {
					  swal(
						  'Perhatian!',
						  'Nomor surat harap untuk diisi!',
						  'warning'
					  )
				  }


				  function hapus(id) {
                      const swalWithBootstrapButtons = swal.mixin({
                      confirmButtonClass: 'btn btn-success',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false
					  })
                    swalWithBootstrapButtons({
                      title: 'Are you sure?',
                      text: "Seluruh Data yang berkaitan dengan surat ini akan terhapus! Anda tidak bisa mengembalikannya lagi",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonText: 'Yes, delete it!',
                      cancelButtonText: 'No, cancel!',
                      reverseButtons: true
                    }).then((result) => {
                      if (result.value) {
                        window.location = '<?php echo base_url() ?>surat/hapus_surat/'+id;
                      } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                      ) {
                        swalWithBootstrapButtons(
                          'Dibatalkan',
                          'Jangan gegabah :)',
                          'error'
                        )
                      }
                    })
				  }
				  <?php if  (isset($_SESSION["berhasil"])) {?>

					  swal({
						  title: "Berhasil",
						  text: "Surat berhasil dihapus",
						  type: "success",
					  });
				  <?php } ?>
				  <?php unset($_SESSION['berhasil']) ?>
			  </script>

<div class="container-fluid">
      <div class="btn-group">
        <a href="<?php  echo base_url('surat/buat_surat_dinas')?>"> <button class="btn animated bounceInLeft btn-indigo btn-fab" type="button" data-toggle="modal" data-target="#modalRegisterForm" id="main"><i class="fa fa-plus" aria-hidden="true">
          </i> Tambah</button> 
        </a>
      </div>
    </div>
  </div>

		  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				  <div class="modal-content">
					  <form action="<?php echo base_url('Surat/edit/'.$row->id)?>" method="post">
						  <div class="modal-header text-center">
							  <h4 class="modal-title w-100 font-weight-bold">Edit nomor surat</h4>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
							  </button>
						  </div>
						  <div class="modal-body mx-3">
							  <div class="md-form mb-5">
								  <i class="fa fa-sort-numeric-asc prefix grey-text"></i>
								  <input type="text" id="form3" class="form-control validate" name="nomor"
										 value="<?php  echo $row->nomor?>">
								  <label data-error="wrong" data-success="right" for="form3">Nomor surat</label>
							  </div>

						  </div>
						  <div class="modal-footer d-flex justify-content-center">
							  <button class="btn btn-indigo">Send <i class="fa fa-edit ml-1"></i></button>
						  </div>
					  </form>
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
