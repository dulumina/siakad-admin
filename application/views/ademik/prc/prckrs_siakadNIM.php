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
			Proses Ambil data dari siakad lama ke siakad baru
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="<?= $_SESSION['tamplate'] ?>">Proses Kirim data KHS ke Feeder</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Proses ambil data KRS lama ke KRS Siakad Baru</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form action="<?= base_url("ademik/prc/prckrs_siakadNIM/prc_krs_lama") ?>" method="POST">
							<div class="col-md-12">
								<div class="row">
									<input class="col-md-3" style="margin-right: 10px;" type="text" name="nim" class="form-control" placeholder="Masukkan NIM">
									<input class="col-md-3" type="text" name="tahun" class="form-control" placeholder="Masukkan tahun">
								</div>
							</div>
					
							<div style="margin: 30px 0px 10px 0px">
								<button type="submit" class="btn btn-primary">PRC</button>
							</div>
						</form>
						<div id='hasil'></div>
					</div>
					<!-- /.box-body -->
				</div>

			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>