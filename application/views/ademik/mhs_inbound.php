<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Rekap Mahasiswa Inbound
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Rekap</a></li>
			<li class="breadcrumb-item"><a href="<?= $_SESSION['tamplate'] ?>">Mahasiswa Inbound</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Rekap Data</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">


					<!-- <div class="row col-md-12">
	            	<div>
	            		<div class="box-header">
	              			
	            		</div>
			            <div class="box-body">
				            <table class="table table-bordered table-striped table-responsive dataTable">
				                <thead>
									<tr>
										<th>Kode Prodi</th>
										<th>Nama Prodi</th>
										<th>NIM</th>
										<th>Nama</th>
										<th>Univ Asal</th>
										<th>Prodi Asal</th>
										
									</tr>
								</thead>
								<tbody>

									

								</tbody>
								
							</table>
						</div>
					</div>	
					</div> -->





					<div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style="text-align: center;">
                    <th>Kode Prodi</th>
					<th>Nama Prodi</th>
					<th>NIM</th>
					<th>Nama</th>
					<th>Univ Asal</th>
					<th>Prodi Asal</th>
                  </tr>
                  </thead>
                  <tbody> 

                  	<?php 
						
						foreach($mhs as $u){ 
					?>   

					<tr>
						<td><?php echo $u['kodeprodi'] ?></td>
						<td><?php echo $u['namaprodi'] ?></td>
						<td><?php echo $u['nim'] ?></td>
						<td><?php echo $u['name'] ?></td>
						<td><?php echo $u['univ_asal'] ?></td>
						<td><?php echo $u['prodi_asal'] ?></td>
					</tr>

					<?php } ?>   

                  </tbody>
                 <tfoot>
					<tr>
						<th>Kode Prodi</th>
						<th>Nama Prodi</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Univ Asal</th>
						<th>Prodi Asal</th>
					</tr>
				</tfoot>
                </table>

              </div>


						<!-- Isi disini -->

						
						
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
