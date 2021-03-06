<script>
	wait$(() => {


		$(document).ready(function() {
			$('#cari').click(function() {
				let nim = $("#nim").val();
				// console.log('tessss');
				$.ajax({
					type: 'POST',
					url: '<?= base_url() ?>ademik/Khs_inbound/mhs',
					data: {
						nim: nim
					},
					success: function(mahasiswa) {
						let hasil = JSON.parse(mahasiswa);
						console.log(hasil);


						$("#nama").val(hasil.name);
						$("#fak").val(hasil.KodeFakultas);
						$("#jur").val(hasil.prodi_asal);
						in_periode(nim);

					}
				});
			});
		});


		$(document).ready(function() {
			$('#tperiode').click(function() {
				let periode = $("#periode").val();
				let nim = $("#nim").val();
				// console.log(nim);
				$.ajax({
					type: 'POST',
					url: '<?= base_url() ?>ademik/Khs_inbound/tkhs',
					data: {
						nim: nim,
						periode: periode
					},
					success: function(ini) {
						let isi_khs = JSON.parse(ini);
						console.log(isi_khs);
						renderkhs(isi_khs.dataa);
						$("#ambil-nim").val(nim);
						$("#ambil-periode").val(periode);
					}
				});

			});
		});

		function in_periode(ini) {

			$.ajax({
				type: 'POST',
				url: '<?= base_url() ?>ademik/Khs_inbound/periode',
				data: {
					nim: ini
				},
				success: function(set) {
					let prd = JSON.parse(set);
					console.log(prd);
					var html = '';
					var i;
					var a;

					// 
					for (i = 0; i < prd.length; i++) {
						html += '<option value=' + prd[i].tahun + '>' + prd[i].tahun + '</option>';
					}
					$('#periode').html(html);


				}
			});
		}


	function renderkhs(params) {
			let nilai = $('#example').DataTable();
			nilai.clear();
			nilai.destroy();
			nilai = $('#example').DataTable({
				data: params,
				columns: [{
						data: 'nim'
					},
					{
						data: 'name'
					},
					{
						data: 'tahun'
					},
					{
						data: 'NamaMK'
					},
					{
						data: 'GradeNilai'
					},
				],
				columnDefs:[{
					targets:3,
					render: function (data, type, row, meta) {
						let listDosen=row.dosen;
						let dosen='';
						for (let i = 0; i < listDosen.length; i++) {
							dosen += i+1 + '). ' + listDosen[i].nama_dosen+'<br>';
						}
						return '<b>' + data +'</b><br>'+dosen
					}
				}]

			}).draw();
			document.getElementById("cetak_khs").disabled = false;

		}
	})
</script>




<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Kartu Hasil Studi Mahasiswa Inbound
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Mahasiswa Inbound</a></li>
			<li class="breadcrumb-item"><a href="<?= $_SESSION['tamplate'] ?>">KHS Inbound</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Kartu Hasil Studi (KHS)</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">

						<div class="form-group row">
							<label class="col-sm-2 control-label">
								<h6>NIM</h6>
							</label>
							<div class="col-sm-4">

								<?php
								$ulevel = $this->session->userdata('ulevel');
								$nim_mhs = $this->session->userdata('unip');

								if ($ulevel == 10) {
								?>
									<input type="text" class="form-control" id='nim' name="nim" placeholder="NIM" value="<?= $nim_mhs ?>" readonly>
								<?php
								} else {
								?>
									<input type="text" class="form-control" id='nim' name="nim" placeholder="NIM">
								<?php
								}
								?>



							</div>
							<div class="col-sm-2">
								<input class="btn btn-flat btn-info" type="button" id="cari" name="cari" value="Search">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 control-label">
								<h6>Nama</h6>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id='nama' name="nama" placeholder="Nama" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 control-label">
								<h6>Fakultas</h6>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id='fak' name="fak" placeholder="Fakultas" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 control-label">
								<h6>Prodi Asal</h6>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id='jur' name="jur" placeholder="Jurusan" readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="box">

							<div class="form-group row" style="padding:15px;">
								<label class="col-sm-2 control-label">
									<h6>Periode</h6>
								</label>
								<div class="col-sm-4">

									<select class="form-control select2 dosen" style="width: 100%;" id="periode" name="periode">
										<option>--Pilih Periode--</option>

									</select>
								</div>
								<div class="col-sm-4">

									<button class="btn btn-flat btn-info" id="tperiode" name="tperiode"><i class="fa fa-refresh"></i></button>



								</div>
								<!-- <div class="col-sm-2">
												<input class="btn btn-flat btn-info" type="button" id="search" name="search" value="Search">
											</div> -->
							</div>

							<div class="card card-default">
								<div class="card-header">
									<!-- <form action="<?= base_url() ?>ademik/Nilai_inbound/Cetak_dpna" method="get"> -->
									<form action="<?= base_url() ?>ademik/Khs_inbound/cetak_khs" method="get">
										<!-- <form name="form" action="" method="post"> -->

										<input type="hidden" name="ambil-nim" id="ambil-nim">
										<input type="hidden" name="ambil-periode" id="ambil-periode">

										<!-- </form> -->

										<button class="btn btn-flat btn-info" id="cetak_khs" style="float: right;" disabled><i class="fa fa-print"></i> Cetak KHS</button>
									</form>
								</div>
								<div class="card-body">
									<table id="example" class="table table-bordered table-striped ">
										<thead>
											<tr style="text-align: center;">
												<th>NIM</th>
												<th>Nama</th>
												<th>Tahun</th>
												<th>Mata Kuliah</th>
												<th>Nilai</th>

											</tr>
										</thead>
										<tbody>

										</tbody>
										<tfoot>
											<tr>
												<th>NIM</th>
												<th>Nama</th>
												<th>Tahun</th>
												<th>Mata Kuliah</th>
												<th>Nilai</th>

											</tr>
										</tfoot>
									</table>
								</div>
							</div>

						</div>
					</div>
				</div>




				<!-- Isi disini -->



			</div>

		</div>
	</section>
	<!-- /.content -->
</div>