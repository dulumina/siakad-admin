<!-- <style type="text/css">
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
</style> -->

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Mata Kuliah Bersyarat
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="#">AdmAkd</a></li>
			<li class="breadcrumb-item active">MK Bersyarat</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div id="divmk" class="col-xl-12 col-lg-12">

				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">MK Bersyarat</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="mk" class="table table-bordered table-striped table-responsive">
							<thead>
								<tr>
									<th>NO</th>
									<th>Kode</th>
									<th>Nama MK</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($data as $data) { ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $data->IDMK ?></td>
										<td><?= $data->Nama_Indonesia ?></td>
										<td>
											<a type="button" class="btn btn-xs btn-primary lihat" id="<?= $data->IDMK; ?>" mk="<?= $data->Nama_Indonesia; ?>"><i class="fa fa-book"></i> Lihat Syarat</a>
											<!-- <a type="button" class="btn btn-xs btn-primary" href="<= base_url('ademik/prasyaratmk/getsyarat/' . $data->IDMK) ?>" id="add">Lihat Syarat</a> -->
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- right column -->
			<div id="divmks" class="col-xl-6 col-lg-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title" id="ket"></h3>
						<a type="button" id="btnclose" class="btn btn-xs btn-danger float-right" href="#"><i class="fa fa-times"></i></a>
						<a type="button" class="btn btn-xs btn-primary float-right mr-1" id="idadd" data-toggle="modal" data-target="#modaltambah"><i class="fa fa-plus"></i></a>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="syarat" class="table table-bordered table-striped table-responsive">
							<thead>
								<tr>
									<th>NO</th>
									<th>Kode</th>
									<th>Nama MK</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="isitab">
							</tbody>
							<!-- <tbody>
								<php
								$no = 1;
								foreach ($syarat as $syarat) { ?>
									<tr>
										<td><= $no++ ?></td>
										<td><= $syarat->PraID ?></td>
										<td><= $syarat->Nama_Indonesia ?></td>
										<td>
											<php if ($syarat->NotActive == 'N') {
												echo "Aktif";
											} else {
												echo "Tidak Aktif";
											} ?>
										</td>
										<td>
											<a type="button" class="btn btn-xs btn-success" href="<= base_url('ademik/prasyaratmk/getsyarat/' . $data->IDMK) ?>"><i class="fa fa-pencil"></i></a>
											<a type="button" class="btn btn-xs btn-danger" href="<= base_url('ademik/prasyaratmk/getsyarat/' . $data->IDMK) ?>"><i class="fa fa-trash-o"></i></a>
										</td>
									</tr>
								<php } ?>
							</tbody> -->
						</table>
					</div>
				</div>
				<!-- /.box -->
			</div>

			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>

<div class="modal fade" id="modaltambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addket"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form" method="POST">
					<div class="form-group">
						<label>Matakuliah</label>
						<input type="text" class="form-control" id="idmakul" name="idmakul" hidden>
						<input type="text" class="form-control" id="makul" name="makul" readonly>
					</div>
					<div class="form-group">
						<label>Kode Matakuliah</label>
						<input type="text" class="form-control" id="kodemakul" name="kodemakul" readonly>
					</div>
					<div class="form-group">
						<label>Syarat Matakuliah</label>
						<select name="snmk" id="snmk" class="form-control" style="width: 100%;">
						</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status" id="status" name="status" class="form-control">
							<option value="null" selected>Select Status</option>
							<option value="N">Aktif</option>
							<option value="Y">Tidak Aktif</option>
						</select>
					</div>
					<button type="button" class="btn btn-primary float-right ml-1" id="add">Submit</button>
					<button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	wait$(() => {
		// JS Datatabels
		$(document).ready(function() {
			$('#mk').dataTable();
			$('#divmks').hide();

			$('#snmk').select2({
				ajax: {
					url: '<?= base_url() ?>ademik/prasyaratmk/getmk',
					dataType: "json",
					type: "POST",
					delay: 250,
					data: function(params) {
						return {
							data: params.term,
						}
					},
					processResults: function(data) {
						return {
							results: data
						};
						console.log($data);
					},
					cache: true,
				},
				placeholder: '-- Pilih Mata Kuliah --',
				minimumInputLength: 4,
			});
		});

		$(".lihat").click(function() {
			var id;
			var mk;
			id = $(this).attr("id");
			mk = $(this).attr("mk");
			$('#divmk').removeClass('col-xl-12');
			$('#divmk').addClass('col-xl-6');
			$('#makul').val(mk);
			$('#kodemakul').val(id);
			$('#ket').html('Syarat MK ' + mk);
			$('#addket').html('Tambah Syarat MK ' + mk);
			$.ajax({
				type: 'POST',
				data: 'id=' + id,
				url: '<?= base_url() ?>ademik/prasyaratmk/getdetail',
				success: function(response) {
					var data = JSON.parse(response);
					$('#isitab').html(data.mk);
					$('#divmks').show();
					$('#idadd').val(data.id);
					$('#idmakul').val(data.kode);
					$('#modaltambah').modal('hide');
				}
			});
		});

		$("#btnclose").click(function() {
			$('#divmk').removeClass('col-xl-6');
			$('#divmk').addClass('col-xl-12');
			$('#divmks').hide();
		});

		$("#add").click(function() {
			var data = $('#form').serialize();
			var id = $('#kodemakul').val();
			$('#modaltambah').modal('hide');
			$('#snmk').val(null).trigger('change');
			$('#status').val('null');
			$.ajax({
				type: 'POST',
				url: "<?= base_url() ?>ademik/prasyaratmk/add",
				data: data,
				cache: false,
				success: function(response) {
					// Reload Table
					$.ajax({
						type: 'POST',
						data: 'id=' + id,
						url: '<?= base_url() ?>ademik/prasyaratmk/getdetail',
						success: function(response) {
							var data = JSON.parse(response);
							successadd();
							$('#isitab').html(data.mk);
							$('#divmks').show();
							// $('#idadd').val(data.id);
							$('#idmakul').val(data.kode);
						}
					});
				},
				error: function() {
					// error();
					alert('Astaga Salah Cok');
				}
			});
		});

	})

	function successup() {
		swal("Good job!", "Success Update Status!", "success")
	}

	function successadd() {
		swal("Good job!", "Success added!", "success")
	}

	function update(PraID, NotActive) {
		var id = $('#kodemakul').val();
		$.ajax({
			type: 'POST',
			data: {
				IDMK: id,
				PraID: PraID,
				NotActive: NotActive,
			},
			url: '<?= base_url() ?>ademik/prasyaratmk/update',
			success: function(response) {
				$.ajax({
					type: 'POST',
					data: 'id=' + id,
					url: '<?= base_url() ?>ademik/prasyaratmk/getdetail',
					success: function(response) {
						var data = JSON.parse(response);
						successup();
						$('#isitab').html(data.mk);
						$('#divmks').show();
						// $('#idadd').val(data.id);
						$('#idmakul').val(data.kode);
					}
				});
			}
		});
	}
</script>