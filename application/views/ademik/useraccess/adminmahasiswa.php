<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Halaman Management Mahasiswa
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<!-- <li class="breadcrumb-item"><a href="<?= $_SESSION['tamplate'] ?>">KRS</a></li> -->
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Management User Mahasiswa</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						  <?php
							if($this->session->ulevel==1){
								echo '<a href="'.base_url('ademik/useraccess/addadminmahasiswa').'" class="btn btn-flat btn-success" style="margin-bottom: 20px;">Tambah Mahasiswa</a>';
							}
						?> 
						
						 <!-- <table id="table_admin" class="table table-bordered table-striped table-responsive">
                			<thead>
								<tr>
									<th>Name</th>
									<th>Login</th>
									<th>Email</th>
									<th>Phone</th>
									<th>N/A</th>
									<?php
										// if($this->session->ulevel==1){
										// 	echo "<th>Action</th>";											
										//}
									?>
								</tr>
							</thead>
							<tbody>
							</tbody>
             			</table>  -->

             			<!-- Kaledo24 -->

             			<div class="box-body">
							<form class="form-horizontal" action="<?=base_url();?>ademik/UserAccess/datamhsw" method="POST">
								<div class="form-group row">
									<label class="col-sm-1 control-label">STAMBUK</label>
									<div class="col-sm-3">
										<input class="form-control" type="text" name="nim" id="nim" placeholder="Input Stambuk Mahasiswa" />
									</div>
									<div class="col-sm-2">
										<!-- <input class="btn btn-flat btn-info" type="button" id="search" name="search" value="Search"> -->
										<!-- <input class="btn btn-flat btn-info" type="button" id="search" name="search" value="Search"> --> 
										<!-- <button type="button" onclick="search()" id="cari" class="btn btn-flat btn-info" >Search</button> -->
										<button type="submit" name="search" id="cari" class="btn btn-flat btn-info" >Search</button>
									</div>
								</div>
							</form>
							<!-- <table id="table_adminn" class="table table-bordered table-striped table-responsive">
	                			<thead>
									<tr>
										<th>Name</th>
										<th>Login</th>
										<th>Email</th>
										<th>Phone</th>
										<th>N/A</th>
										<?php
											// if($this->session->ulevel==1){
											// 	echo "<th>Action</th>";											
											//}
										?>
									</tr>
								</thead>
								<tbody>
								</tbody>
	             			</table> -->
						</div>
						<?php
						if ( isset($dataTabel) ) { ?>

			            		<div class="box-body">
			              			<table id="example1" class="table table-bordered table-striped table-responsive">
			                			<thead>
											<tr>
												<th style="text-align: center;">No</th>
												<th style="text-align: center;">Login</th>
												<th style="text-align: center;">Name</th>
												<th style="text-align: center;">Email</th>
												<th style="text-align: center;">Phone</th>
												<th style="text-align: center;">N/A</th>
												
											</tr>
										</thead>
										<tbody>
											<?php
												$no=1; 
												foreach ($dataTabel as $tampil) {  ?>
													

												<tr>
													<th style="text-align: center;"><?= $no++ ?></th>
													<th style="text-align: center;">
														<a style="color: red;" href="<?=base_url();?>ademik/UserAccess/editadminmahasiswa/<?= $tampil['ID'] ?>">
															<?php echo $tampil['Login']; ?>	
														</a>
													</th>
													<th><?php echo $tampil['Name']; ?></th>
													<th><?php echo $tampil['Email']; ?></th>
													<th><?php echo $tampil['Hp']; ?></th>
													<th style="text-align: center;"><?php echo $tampil['NotActive']; ?></th>
													 
												</tr>

											<?php } ?>

										</tbody>
										<tfoot>
											<tr>
												<th style="text-align: center;">No</th>
												<th style="text-align: center;">Login</th>
												<th style="text-align: center;">Name</th>
												<th style="text-align: center;">Email</th>
												<th style="text-align: center;">Phone</th>
												<th style="text-align: center;">N/A</th>
												 
											</tr>
										</tfoot>
			              			</table>
			            		</div>
			            		<!-- /.box-body -->
			            	<?php } else {} ?>

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

<!-- *B542F472B -->

<!-- <?=base_url();?>ademik/UserAccess/datamhsw -->
<script type="text/javascript">
	
	// function search() {
	// 	 $("#cari").click(function(){
	//   		var $nim = $('#nim').val();
	//   		$.ajax({
	//   			url 	:, 
	//   			type 	:'POST',
	//   			data 	:,
	//   			dataType:,
	//   			cache 	:,
	//   			succes: function(data) {
	  				
	//   			}
	//   		})
	//   	});	
	// }

	// $(document).ready() {
	// 	$("#cari").click(function(){
	// 		alert('tes')
			// $.ajax({
			// 	url  : url,
			// 	type : 'POST',
			// 	data : data,
			//  dataType :'json',
			//  cache : false
			// succes: function(respon) {

			// }

			// })
	// 	}
	// });

</script>
