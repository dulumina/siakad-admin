<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Halaman Management Admin Jurusan
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
						<h3 class="box-title">Management User Admin Jurusan</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php
							if($this->session->ulevel==1){
								echo '<a href="'.base_url('ademik/useraccess/addadminjur').'" class="btn btn-flat btn-success" style="margin-bottom: 20px;">Tambah Admin jurusan</a>';
							}
						?>
						
						<table id="table_admin" class="table table-bordered table-striped table-responsive">
                			<thead>
								<tr>
									<th>Name</th>
									<th>Login</th>
									<th>Kode Fakultas</th>
									<th>Kode Jurusan</th>
									<th>Email</th>
									<th>Phone</th>
									<th>N/A</th>
									<?php
										if($this->session->ulevel==1){
											echo "<th>Action</th>";											
										}
									?>
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
	</section>
	<!-- /.content -->
</div>
