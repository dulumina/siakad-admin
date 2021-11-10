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
			INDEX PRESTASI KUMULATIF PRODI
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="<?= $_SESSION['tamplate'] ?>">Cetak KHS 2</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Proses KHS dan IPK</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php 
							if(isset($this->session->msg)){
						   		echo '<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<i class="ti-alert pr-15"></i>'.$this->session->msg.'</div>'; 
							}
						?>
						<form class="form-horizontal" method="POST" action="<?= base_url('ademik/cetak_khs_prodi/search'); ?>">
							<div class="form-group row">
								<label class="col-sm-2 control-label">Semester Akademik</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id='semesterAkademik' name="semesterAkademik" placeholder="Semester Akademik">
								</div>
								<div class="col-sm-2">
									<input class="btn btn-flat btn-info" type="submit" id="search" name="search" value="Search">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">Program</label>
								<div class="col-sm-4">
									<select name="program" id="program" class="form-control select2">
										<option value="">- Pilih Program -</option>
										<option value="REG">REG - Program Reguler</option>
										<option value="RESO">RESO - Program Non Reguler</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">Jurusan</label>
								<div class="col-sm-4">
									<select name="jurusan" id="jurusan" class="form-control select2">
										<option value="">- Pilih Jurusan -</option>
										<?php
											foreach ($jurusan as $show) {
										?>
												<option value="<?= $show->Kode; ?>"><?= $show->Kode." - ".$show->Nama_Indonesia; ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label">Angkatan</label>
								<div class="col-sm-4">
									<select name="angkatan" id="angkatan" class="form-control select2">
										<option value="">- Pilih Angkatan -</option>
										<!-- <option name="All">All</option> -->
										<?php foreach($tahunAngkatan as $tahun) : ?>
											<option name="<?= $tahun['angkatan']; ?>"><?= $tahun['angkatan']; ?></option>
    									<?php endforeach; ?>
									</select>
								</div>
							</div>
						</form>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->   
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<?php
			if(isset($semester)){		
		?>
		<div class="row" id="isiContent">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Proses KHS dan IPK</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body" id='boxContent'>
						<table>
							<tr>
								<!-- <td><a href="<?= base_url('ademik/cetak_khs_prodi/prcIps/'.$semester.'/'.$program.'/'.$jur.'/'.$angkatan); ?>" class="btn btn-block btn-info">Proses IP Semester</a></td>
								<td><a href="<?= base_url('ademik/cetak_khs_prodi/prcIpk/'.$semester.'/'.$program.'/'.$jur.'/'.$angkatan); ?>" class="btn btn-block btn-info">Proses IP Komulatif</a></td>
								<td><a href="<?= base_url('ademik/cetak_khs_prodi/resetIps/'.$semester.'/'.$program.'/'.$jur.'/'.$angkatan); ?>" class="btn btn-block btn-info">Reset IPS Kosong</a></td> -->
								<td><a href="<?= base_url('ademik/report/report/cetak_khs_prodi/'.$semester.'/'.$program.'/'.$jur.'/'.$angkatan.'/'.$fakultas); ?>" class="btn btn-block btn-info">Cetak KHS</a></td>
								<td></td>
							</tr>
						</table>
						
						<table class="table table-bordered" id="tabel_cetak_khs">
			        		<thead>
			        			<tr>
			        				<th>No.</th>
			        				<th>NIM</th>
			        				<th>Nama</th>
			        				<th>PROG</th>
			        				<th>Tahun</th>
			        				<th>Status</th>
			        				<th>SKS</th>
			        				<th>SKS Lulus</th>
			        				<th>IPS</th>
			        				<th>Tot. SKS</th>
			        				<th>Tot. SKS Lulus</th>
			        				<th>IPK</th>
			        				<th>Status Proses</th>
			        				<th>Feeder KHS</th>
			        				<th>Feeder KRS</th>
			        				<th>Action</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			
			        		</tbody>
			        	</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->   
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
		<?php
			}
		?>

	</section>
	<!-- /.content -->
</div>
<script type="text/javascript">
	function kirimDikti(nim,thn){
		//alert(nim+" "+thn);
		var dataku = 'nim='+nim+'&thn='+thn;
		$body = $("body");
		$body.addClass("loading");
		$.ajax({
		  url: "<?= base_url('ademik/cetak_khs_prodi/import_khs_feeder'); ?>",
		  data: dataku,
		  type: 'POST',
		  dataType: 'json',
		  cache : false,
		  success: function(res){ 
				// let data = JSON.parse(res);
				// $body.removeClass("loading");
				if(res.error_code==0){
					//var feeder = "#feeder-"+nim;
					//alert("123");
					$("#feeder-"+nim).html("Data Terkirim");
				}
				console.log(data);
				alert(data.pesan);
		  }
		})  
		.fail(function(res) {
			let data = JSON.parse(res);
			alert(data.pesan)
		})
		.always(function() {
			$body.removeClass("loading");
			oTable.ajax.reload();
		});	

	}
</script>
