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
			Proses Kirim data KRS ke Feeder
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
						<h3 class="box-title">Proses Kirim data KRS ke Feeder</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form action="<?= base_url("ademik/prc/prckrs_feeder/import_krs_feeder_all") ?>" method="POST">
							<div class="form-group">
								<select name='fakultas'>
									<option value='A'>FKIP    </option>
									<option value='B'>FISIP   </option>
									<option value='C'>FEKON   </option>
									<option value='D'>FAKUM   </option>
									<option value='E'>FAPERTA </option>
									<option value='F'>FATEK   </option>
									<option value='G'>FMIPA   </option>
									<option value='H'>PASCA   </option>
									<option value='K2T'>Kampus 2 Touna</option>
									<option value='K2M'>Kampus 2 Morowali</option>
									<option value='L'>FAHUT   </option>
									<option value='O'>FAPETKAN</option>
									<option value='P'>FKM     </option>
									<option value='N'>FK    </option>
								</select>
								<input type="text" name="tahun" class="form-control" placeholder="Masukkan tahun">
							</div>
					
							<div style="margin: 50px 0px 10px 218px">
								<button type="submit" class="btn btn-primary">PRC ALL</button>
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