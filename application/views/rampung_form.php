<body>
	<div class="container" style="padding-top: 20vh; padding-bottom: 15vh">
		<div class="card mb-6">
			<div style="margin-left: 5%; margin-top: 5%">
				  	<h3 class="card-title">ISIAN FORM RAMPUNG</h3>
				  </div>
			<div class="card-body" style="margin-left: 3%">
				<!-- Default form contact -->
			<form class="needs-validation"
				  action="<?php echo base_url('C_PDF/print_rampung/'.$slug) ?>"
				  method="post">
				
				<table class="table table-responsive">
					<!-- BAGIAN FORM DINAMIS INI AKAN MUNCUL JIKA USER MENGKLIK OPSI BANYAK TEMPAT-->
					<!--elemet sebagai target append-->
					<tbody id="itemlist">
					<tr>
							<input type="checkbox" onclick="cek()" name="isMultiple" id="isMultiple"> Penginapan lebih dari 1 malam? <br/>
						<td>
							<label for="validationCustom02">Uang Penginapan</label>
							<input type="number" class="form-control" id="inap" name="inap"
								   placeholder="Rp " required>
						</td>
						<td>
							<label for="validationCustom02">Tiket Pesawat</label>
							<input type="number" class="form-control" id="validationCustom02" name="tiket"
								   placeholder="Rp " required></td>
						<td>
							<button class="btn btn-primary" id="btn_tambah" disabled onclick="additem(); return false"><i class="fas fa-plus-square"></i></i></button>
						</td>
					</tr>
					</tbody>
				</table>
				<div style="float: right; padding-right: 20px;">
						<p>*Pastikan jumlah malam tidak lebih dari <?php echo $malam ?> malam </p>	
						<div style="float: right;"><button class="btn btn-indigo" type="submit" name="rsubmit">Print Surat</button>	</div>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
<script>
	var i = 1;
	//j sebagai counter klik cek()
	var j = 0;
	function additem() {
//                menentukan target append
		var itemlist = document.getElementById('itemlist');

//                membuat element
		var row = document.createElement('tr');
		var penginapan = document.createElement('td');
		var malam = document.createElement('td');
		var aksi = document.createElement('td');

//                meng append element
		itemlist.appendChild(row);
		row.appendChild(penginapan);
		row.appendChild(malam);
		row.appendChild(aksi);


		var penginapan_input = document.createElement('input');
		penginapan_input.setAttribute('name', 'penginapan['+ i +']');
		penginapan_input.setAttribute('type', 'number');
		penginapan_input.setAttribute('class', 'form-control');
		penginapan_input.setAttribute('placeholder', 'Rp ');
		penginapan_input.setAttribute('required', 'true');

		var malam_input = document.createElement('input');
		malam_input.setAttribute('name', 'malam['+ i +']');
		malam_input.setAttribute('type', 'number');
		malam_input.setAttribute('class', 'form-control');
		malam_input.setAttribute('placeholder', 'Jumlah malam');
		malam_input.setAttribute('required', 'true');


		var hapus = document.createElement('span');

//                meng append element input
		penginapan.appendChild(penginapan_input);
		malam.appendChild(malam_input);
		aksi.appendChild(hapus);

		hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="fas fa-trash-alt"></i></button>';
//                membuat aksi delete element
		hapus.onclick = function () {
			row.parentNode.removeChild(row);
		};

		//Jika lebih dari jumlah malam maka tombol tambah gabisa di klik
		if (i >= <?php echo $malam ?> ) {
			var btn = document.getElementById('btn_tambah');
			btn.disabled = true;
		}

		i++;
	}

	function cek() {
		var checkbox = document.getElementById('isMultiple');
		var inap = document.getElementById('inap');
		var btntambah = document.getElementById('btn_tambah');
		if(checkbox.checked) {
			btntambah.disabled = false;
			//inap.style.display = "none";
			inap.disabled = true;

		} else {
			btntambah.disabled = true;
			inap.style.display = "block";
			inap.disabled = false;
		}

		//add item  hanya bisa dilakukan sekali
		if(j < 1) {
			additem();
		}
		j++;
	}

</script>
</body>

