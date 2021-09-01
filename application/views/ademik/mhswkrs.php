<style type="text/css">
	.modal-fullscreen {
	  padding: 0 !important;
	}
	.modal-fullscreen .modal-dialog {
	  width: 100%;
	  height: 100%;
	  margin: 0;
	  padding: 0;
	  max-width: 100%;
	}
	.modal-fullscreen .modal-content {
	  height: auto;
	  min-height: 100%;
	  border: 0 none;
	  border-radius: 0;
	}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Kartu Rencana Studi (KRS)
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="<?= $_SESSION['tamplate'] ?>">KRS</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Kartu Rencana Studi</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form class="form-horizontal" action="<?= base_url('ademik/mhswkrs/search'); ?>">
							<div class="form-group row">
								<label class="col-sm-2 control-label">Semester Akademik</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="semesterAkademik" name="semesterAkademik" placeholder="Semester Akademik">
								</div>
								<div class="col-sm-2">
									<input class="btn btn-flat btn-info" type="button" id="search" name="search" value="Search">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">NIM</label>
								<div class="col-sm-4">
									<?php
										if($_SESSION['ulevel']==4){
											$readonly='readonly value="'.$_SESSION['unip'].'"';
										}else{
											$readonly='';
										}	
									?>
									<input type="text" class="form-control" id='nim' name="nim" placeholder="NIM" <?= $readonly; ?>>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">NAMA</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id='nama' name="nama" readonly placeholder="NAMA">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">JURUSAN</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id='jurusan' name="jurusan" readonly placeholder="JURUSAN">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">PROGRAM</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id='program' name="program" readonly placeholder="PROGRAM">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">DOSEN</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id='dosen' name="dosen" readonly placeholder="DOSEN">
								</div>
							</div>
						</form>
					</div>
					<!-- /.box-body -->
					<div class="callout callout-info">
						<h4>Keterangan :</h4>
						<p>
							- Fitur ini di gunakan untuk menampilkan dan mengelola KRS per mahasiswa <br>
							- Cek data di PDDIKTI Klik disini <a class="text-light bg-warning" href="https://pddikti.kemdikbud.go.id/">PDDIKTI Kemendikbud</a> <br>
							- Pastikan setiap semesternya data terdapat di PDDIKTI <br>
							
						</p>
					</div>
					<div class="callout callout-success">
						<h4>Kuesioner :</h4>
						<div class="col-6">
							Bagi seluruh mahasiswa Universitas Tadulako, diharapkan untuk mengisi kuesioner survey kepuasan mahasiswa atas layanan Universitas Tadulako. Kuesioner tersebut untuk mengetahui tingkat kepuasan dan kepentingan dari layanan yang telah diberikan oleh Universitas Tadulako, serta menghimpun pendapat mahasiswa untuk bahan evaluasi dan masukkan dalam penyusunan rencana layanan periode berikutnya. <a class="text-light bg-warning" id="lnkkuisioner" href="<?= base_url('ademik/mhswkrs/directLink/kuesioner') ?>" role="button">Link Kuesioner</a>
						</div>
					</div>
					<!-- <div class="col-12">
						<div class="form-group row">
							<div class="col-sm-4">
								<iframe width="450" height="200" src="https://www.youtube.com/embed/PcZTBKYxuc8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
							<div class="col-sm-4">
								<iframe width="450" height="200" src="https://www.youtube.com/embed/VhHP0rcwc7k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
							<div class="col-sm-4">
								<iframe width="450" height="200" src="https://www.youtube.com/embed/6mw3Pn1KOX8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
						</div>
					</div> -->
				</div>
				<!-- /.box -->   
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
		
		<div class="row" id="isiContent">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Kartu Rencana Studi</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body" id='boxContent'>
						
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->   
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>


<div class="modal fade modal-fullscreen" id="modal-addKrs">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#389af0;">
				<h5 class="modal-title" style="color:#FFF;">Tambah KRS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body" >
				<div id="form">
					<div class="row">
						<div class="col-md-6 align-self-center">
							<p class="margin">Matakuliah</p>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" id="CariMk" >
									<span class="input-group-btn">
										<button type="button" class="btn btn-info btn-flat" id="getMk">Go!</button>
									</span>
							</div>
						</div>
					</div>
				</div>
				<br><hr>
				<div id='isiAddKrs'>
				
				</div>
			</div>
		</div>
	</div>
</div>
<!-- MODAL ADD -->


<div class="modal fade modal-fullscreen" id="modal-addPaket">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#389af0;">
				<h5 class="modal-title" style="color:#FFF;">Tambah PAKET</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body" id='isiAddPaket'>
				
			</div>
		</div>
	</div>
</div>
<!-- MODAL PAKET -->

<div class="modal fade modal-fullscreen" id="modal-registrasiUlang">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#389af0;">
				<h5 class="modal-title" style="color:#FFF;">Registrasi Ulang Mahasiswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body" id='isiRegistrasiUlang'>
				
			</div>
		</div>
	</div>
</div>
<!-- MODAL REGISTRASI ULANG -->

<!-- Modal kuisioner -->
<div class="modal fade" id="kuisioner" tabindex="-1" role="dialog" aria-labelledby="kuisionerTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kuisionerTitle">Kuesioner Kepuasan Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bagi seluruh mahasiswa Universitas Tadulako, diharapkan untuk mengisi kuesioner survey kepuasan mahasiswa atas layanan Universitas Tadulako. Kuesioner tersebut untuk mengetahui tingkat kepuasan dan kepentingan dari layanan yang telah diberikan oleh Universitas Tadulako, serta menghimpun pendapat mahasiswa untuk bahan evaluasi dan masukkan dalam penyusunan rencana layanan periode berikutnya.<hr>
				<div class="col-md-12 text-center">
            <a class="btn btn-primary" id="lnkkuisioner" href="<?= base_url('ademik/mhswkrs/directLink/kuesioner') ?>" role="button">Link Kuesioner</a>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- Modal kuisioner -->

<script>
	var i = setInterval(function() {
		if ($) {
			clearInterval(i);

			$(function(){
				<?php
					if(isset($success)){
						echo "
							swal({   
									title: 'Success !',   
									type: 'success',    
									html: true, 
									text: '".$success."',
									confirmButtonColor: '#f7cb3b',   
								});
						";
					}
					if(isset($error)){
						echo "
							swal({   
									title: 'Error !',   
									type: 'error',    
									html: true, 
									text: '".$error."',
									confirmButtonColor: '#f7cb3b',   
								});
						";
					}
				?>

				$('#isiContent').hide();
				$('#search').click(function(){
					var nim = $('#nim').val();
					var semesterAkademik = $('#semesterAkademik').val();
					var dataku = 'nim='+nim+'&semesterAkademik='+semesterAkademik;
					$body = $("body");
					$body.addClass("loading");
					$.ajax({
						url: "<?= base_url('ademik/mhswkrs/search'); ?>",
						data: dataku,
						type: 'POST',
						dataType: 'json',
						cache : false,
						success: function(msg){ 
							$body.removeClass("loading");
							if(msg.semesterAkademik || msg.nim){
								var errSmsAkademik = msg.semesterAkademik.replace("<p>", "");
								var errSmsAkademik = errSmsAkademik.replace("</p>", "");
								var errNim = msg.nim.replace("<p>", "");
								var errNim = errNim.replace("</p>", "");
								swal({   
									title: 'Peringatan',   
									type: 'warning',    
									html: true, 
									text: errSmsAkademik+'<br />'+'<br />'+errNim,
									confirmButtonColor: '#f7cb3b',   
								});
								clearView();
							}else if(msg.error){
								console.log(msg.error);
								swal({   
									title: 'Peringatan',   
									type: 'warning',    
									html: true, 
									text: msg.error,
									confirmButtonColor: '#f7cb3b',   
								});
								clearView();
							}else{
								$('#semesterAkademik').val(msg.data[0].Tahun);
								$('#nim').val(msg.data[0].NIM);
								$('#nama').val(msg.data[0].Name);
								$('#jurusan').val(msg.data[0].nama_jurusan);
								$('#program').val(msg.data[0].KodeProgram);
								$('#dosen').val(msg.data[0].nama_dosen);
								//console.log(msg.view);

								$('#isiContent').show();
								document.getElementById("boxContent").innerHTML = msg.view;
								//console.log(msg);

								/*swal({
									title: 'Peringatan',
									text: msg.message,
									type: "warning",
									showCancelButton: true,   
									html: true, 
									confirmButtonColor: '#DD6B55',
									confirmButtonText: 'Tidak',
									cancelButtonText: "Ya",
									closeOnConfirm: false,
									closeOnCancel: false
								},
								function(isConfirm) {
									if (isConfirm) {			
										$display = $("#boxContent");
										$body = $("body");
										$body.addClass("loading");
										$.ajax({
											url: "<?= base_url('ademik/mhswkrs/refreshIpk'); ?>",
											data: dataku,
											type: 'POST',
											dataType: 'json',
											cache : false,
											success: function(msg){ 
												$body.removeClass("loading");

												swal({   
													title: 'Informasi',   
													type: 'info',    
													html: true, 
													text: msg.message,
													confirmButtonColor: '#f7cb3b',   
												});
												$($display).fadeOut(800, function(){
													$display.html(msg.tampil).fadeIn().delay(2000);
												});						
											},
											error: function(err){
												console.log(err);
											}
										});			
									} else {
										swal("Lanjutkan", "Lanjutkan pengisian data", "success");
									}
								});*/
							}	
							
							if(msg.kuisioner){
								// console.log(msg.kuisioner);
								$('#kuisioner').modal('toggle');
							}						
						},
						error: function(err){
							$body.removeClass("loading");
							alert('Terdapat masalah hub. admin');
							console.log(err);
						}
					});
				});

				function clearView(){
					/*$('#semesterAkademik').val('');
					$('#nim').val('');
					$('#nama').val('');
					$('#jurusan').val('');
					$('#program').val('');
					$('#dosen').val('');*/
				}
			});

			$(document).on("click", ".deleteButton", function () {
				var ID = $(this).data('id');
				var nim = $(this).data('nim');
				var thn = $(this).data('thn');

				var dataku = 'ID='+ID+'&nim='+nim+'&thn='+thn;

				swal({
					title: "Peringatan",
					text: "Yakin data ingin dihapus..?",
					type: "warning",
					showCancelButton: true,   
					html: true, 
					confirmButtonColor: '#DD6B55',
					confirmButtonText: 'Iya',
					cancelButtonText: "Batal",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm) {
					if (isConfirm) {	
						$body = $("body");
						$body.addClass("loading");
						$.ajax({
							url: "<?= base_url('ademik/mhswkrs/PrcDel'); ?>",
							data: dataku,
							type: 'POST',
							dataType: 'json',
							cache : false,
							success: function(msg){ 
								$body.removeClass("loading");
								swal({   
									title: 'Success !',   
									type: 'success',    
									html: true, 
									text: msg.message,
									confirmButtonColor: '#f7cb3b',   
								});		
								$("#row_"+msg.id).fadeOut(800);

							},
							error: function(err){
								$body.removeClass("loading");
								alert('Terdapat masalah hub. admin');
								console.log(err);
							}
						});
					} else {
						swal("Batal", "Proses hapus dibatalkan", "error");
					}
				});				
			})

			$(document).on("click", "#refreshIPK", function () {
				var nim = $(this).data('nim');
				var semesterAkademik = $(this).data('thn');
				var dataku = 'nim='+nim+'&semesterAkademik='+semesterAkademik;
				$body = $("body");
				$body.addClass("loading");
				$display = $("#boxContent");
				$.ajax({
					url: "<?= base_url('ademik/mhswkrs/refreshIpk'); ?>",
					data: dataku,
					type: 'POST',
					dataType: 'json',
					cache : false,
					success: function(msg){ 
						$body.removeClass("loading");

						swal({   
							title: 'Informasi',   
							type: 'info',    
							html: true, 
							text: msg.message,
							confirmButtonColor: '#f7cb3b',   
						});
						$($display).fadeOut(800, function(){
							$display.html(msg.tampil).fadeIn().delay(2000);
						});						
					},
					error: function(err){
						$body.removeClass("loading");
						alert('Terdapat masalah hub. admin');
						console.log(err);
					}
				});				
			});
			

			$(document).on("click", "#getMk", function () {
				let addkrsbtn = $('#openModalKrs')
				var id = addkrsbtn.data('id');
				var name = addkrsbtn.data('name');
				var kdj = addkrsbtn.data('kdj');
				var kdp = addkrsbtn.data('kdp');
				var nim = addkrsbtn.data('nim');
				var semesterAkademik = addkrsbtn.data('semester-akademik');
				let keyWord = $('#CariMk').val();
				var dataku = 'id='+id+'&name='+name+'&kdj='+kdj+'&kdp='+kdp+'&nim='+nim+'&semesterAkademik='+semesterAkademik+'&keyWord='+keyWord;
				$body = $("body");
				console.log(dataku);
				$body.addClass("loading");
				$.ajax({
					url: "<?= base_url('ademik/mhswkrs/addKrs'); ?>",
					data: dataku,
					type: 'POST',
					dataType: 'json',
					cache : false,
					success: function(msg){ 
						$body.removeClass("loading");
						document.getElementById("isiAddKrs").innerHTML = msg.isi;

						var button = document.querySelector('#prckrs');
						button.addEventListener('click', function (event) {
							event.preventDefault();
							$body = $("body");
							$body.addClass("loading");
							//alert($('#formPrcKrs').serialize());
							$.ajax({
								url: "<?= base_url('ademik/mhswkrs/saveKrs'); ?>",
								data: $('#formPrcKrs').serialize(),
								type: 'POST',
								dataType: 'json',
								cache : false,
								success: function(msg1){ 
									$body.removeClass("loading");
									//alert(msg.isi+" "+msg.nim+" "+msg.semesterAkademik);
									//alert(msg);	
									if(msg1.error){
										swal({   
											title: 'Peringatan',   
											type: 'warning',    
											html: true, 
											text: msg1.error,
											confirmButtonColor: '#f7cb3b',   
										});		


									}else{
										swal({
											title: "Success !",
											text: msg1.msg,
											icon: "success",
											button: "Ok",  
											html: true, 
										});		

										
									}	

									var nim = $('#nim').val();
									var semesterAkademik = $('#semesterAkademik').val();
									var dataku = 'nim='+nim+'&semesterAkademik='+semesterAkademik;
									$body = $("body");
									$body.addClass("loading");
									$.ajax({
										url: "<?= base_url('ademik/mhswkrs/search'); ?>",
										data: dataku,
										type: 'POST',
										dataType: 'json',
										cache : false,
										success: function(msg){ 
											$body.removeClass("loading");
											if(msg.semesterAkademik || msg.nim){
												var errSmsAkademik = msg.semesterAkademik.replace("<p>", "");
												var errSmsAkademik = errSmsAkademik.replace("</p>", "");
												var errNim = msg.nim.replace("<p>", "");
												var errNim = errNim.replace("</p>", "");
												swal({   
													title: 'Peringatan',   
													type: 'warning',    
													html: true, 
													text: errSmsAkademik+'<br />'+'<br />'+errNim,
													confirmButtonColor: '#f7cb3b',   
												});
												clearView();
											}else if(msg.error){
												swal({   
													title: 'Peringatan',   
													type: 'warning',    
													html: true, 
													text: msg.error,
													confirmButtonColor: '#f7cb3b',   
												});
												clearView();
											}else{
												$('#semesterAkademik').val(msg.data[0].Tahun);
												$('#nim').val(msg.data[0].NIM);
												$('#nama').val(msg.data[0].Name);
												$('#jurusan').val(msg.data[0].nama_jurusan);
												$('#program').val(msg.data[0].KodeProgram);
												$('#dosen').val(msg.data[0].nama_dosen);
												//console.log(msg.view);

												$('#isiContent').show();
												document.getElementById("boxContent").innerHTML = msg.view;
												//console.log(msg);
												
											}							
										},
										error: function(err){									
											$body.removeClass("loading");
											alert('Terdapat masalah hub. admin');
											console.log(err);
										}
									});						
											
								},
								error: function(err){
									$body.removeClass("loading");
									alert('Terdapat masalah hub. admin');
									console.log(err);
								}
							});
						});
					},
					error: function(err){
						$body.removeClass("loading");
						alert('Terdapat masalah hub. admin');
						console.log(err);
					}
				});
			});

			$(document).on("click", "#openModalRegistrasiUlang", function () {
				var nim = $(this).data('nim');
				var semesterAkademik = $(this).data('semester-akademik');
				var dataku = 'nim='+nim+'&semesterAkademik='+semesterAkademik;
				$body = $("body");
				$body.addClass("loading");
				$.ajax({
					url: "<?= base_url('ademik/mhswkrs/registrasiUlang'); ?>",
					data: dataku,
					type: 'POST',
					dataType: 'json',
					cache : false,
					success: function(msg){ 
						$body.removeClass("loading");

						if(msg.isi==""){
							swal({   
								title: 'Peringatan',   
								type: 'warning',    
								html: true, 
								text: msg.error,
								confirmButtonColor: '#f7cb3b',   
							});		
						}else{
							document.getElementById("isiRegistrasiUlang").innerHTML = msg.isi;

							var button = document.querySelector('#prcaddssi');
							$display = $("#displayMhsw");
							button.addEventListener('click', function (event) {
								event.preventDefault();
								$body = $("body");
								$body.addClass("loading");
								//alert($('#formPrcKrs').serialize());
								$.ajax({
									url: "<?= base_url('ademik/mhswkrs/prcAddSsi'); ?>",
									data: $('#formRegUlang').serialize(),
									type: 'POST',
									dataType: 'json',
									cache : false,
									success: function(msg){ 
										$body.removeClass("loading");
										//alert(msg.isi+" "+msg.nim+" "+msg.semesterAkademik);
										//alert(msg);	
										swal({   
											title: 'Informasi',   
											type: 'info',    
											html: true, 
											text: msg.message,
											confirmButtonColor: '#f7cb3b',   
										});		
										$($display).fadeOut(800, function(){
				                            $display.html(msg.displayMhs).fadeIn().delay(2000);
										});
									},
									error: function(err){
										$body.removeClass("loading");
										alert('Terdapat masalah hub. admin');
										console.log(err);
									}
								});
							});

							var button1 = document.querySelector('#displayConfirmReg');
							button1.addEventListener('click', function (event) {
								var nim = $(this).data('nim');
								var thn = $(this).data('thn');
								var dataku = 'nim='+nim+'&thn='+thn;
								$body = $("body");
								$body.addClass("loading");
								$.ajax({
									url: "<?= base_url('ademik/mhswkrs/DispConfirmReg'); ?>",
									data: dataku,
									type: 'POST',
									dataType: 'json',
									cache : false,
									success: function(msg){ 
										$body.removeClass("loading");
										swal({
											title: msg.title,
											text: msg.message,
											type: "warning",
											showCancelButton: true,   
											html: true, 
											confirmButtonColor: '#DD6B55',
											confirmButtonText: 'Registrasi Ulang',
											cancelButtonText: "Batalkan",
											closeOnConfirm: false,
											closeOnCancel: false
										},
										function(isConfirm) {
											if (isConfirm) {							
												$display = $("#displayMhsw");
												$body = $("body");
												$body.addClass("loading");
												$.ajax({
													url: "<?= base_url('ademik/mhswkrs/prcRegUlang'); ?>",
													data: dataku,
													type: 'POST',
													dataType: 'json',
													cache : false,
													success: function(msg){ 
														$body.removeClass("loading");
														swal({
															title: 'Sukses',
															text: msg.success,
															type: 'info',
															html: true, 
														});
														$($display).fadeOut(800, function(){
															$display.html(msg.displayMhs).fadeIn().delay(2000);
														});
													},
													error: function(err){
														$body.removeClass("loading");
														alert('Terdapat masalah hub. admin');
														console.log(err);
													}
												});
											} else {
												swal("Batal", "Registrasi Ulang Batal", "error");
											}
										});
									},
									error: function(err){
										$body.removeClass("loading");
										alert('Terdapat masalah hub. admin');
										console.log(err);
									}
								});
							})
						}
					},
					error: function(err){
						$body.removeClass("loading");
						alert('Terdapat masalah hub. admin');
						console.log(err);
					}
				});
			});

			$(document).on("click", "#openModalPaket", function () {
				var id = $(this).data('id');
				var name = $(this).data('name');
				var kdj = $(this).data('kdj');
				var kdp = $(this).data('kdp');
				var nim = $(this).data('nim');
				var semesterAkademik = $(this).data('semester-akademik');
				var dataku = 'id='+id+'&name='+name+'&kdj='+kdj+'&kdp='+kdp+'&nim='+nim+'&semesterAkademik='+semesterAkademik;
				$body = $("body");
				$body.addClass("loading");
				$.ajax({
					url: "<?= base_url('ademik/mhswkrs/KRSForm2'); ?>",
					data: dataku,
					type: 'POST',
					dataType: 'json',
					cache : false,
					success: function(msg){ 
						$body.removeClass("loading");
						document.getElementById("isiAddPaket").innerHTML = msg.isi;

						var button = document.querySelector('#prcPaket');
						button.addEventListener('click', function (event) {
							event.preventDefault();
							$body = $("body");
							$body.addClass("loading");
							//alert($('#formPrcKrs').serialize());
							$.ajax({
								url: "<?= base_url('ademik/mhswkrs/saveKrs'); ?>",
								data: $('#formPrcKrs').serialize(),
								type: 'POST',
								dataType: 'json',
								cache : false,
								success: function(msg){ 
									$body.removeClass("loading");
									//alert(msg.isi+" "+msg.nim+" "+msg.semesterAkademik);
									//alert(msg);	
									if(msg.error){
										swal({   
											title: 'Peringatan',   
											type: 'warning',    
											html: true, 
											text: msg.error,
											confirmButtonColor: '#f7cb3b',   
										});		
									}else{
										swal({
											title: "Success !",
											text: msg.msg,
											icon: "success",
											button: "Ok",  
											html: true, 
										});						
									}			
											
								},
								error: function(err){
									$body.removeClass("loading");
									alert('Terdapat masalah hub. admin');
									console.log(err);
								}
							});
						});
					},
					error: function(err){
						$body.removeClass("loading");
						alert('Terdapat masalah hub. admin');
						console.log(err);
					}
				});
			});
			
			let kuesioner = "<?= $this->session->userdata('kuesioner'); ?>";
			let unip = "<?= $this->session->userdata('unip'); ?>";
			$(()=>{
				localStorage.setItem("mytime", Date.now());
				if (kuesioner != 1) {
					$('#kuisioner').modal('toggle');
				}
			})

		}
	}, 100);
</script>  
