<!DOCTYPE html>
<html>
<head>
	<title>Cetak KRS</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/components/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<style type="text/css">
		body{
			font-family: calibri;
		}
		h2, h3{
			margin: 0px;
			padding: 0px;
		}
		table.table-mk, .table-mk td, .table-mk th{border: 1px solid black; border-collapse: collapse;}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<table style="width: 100%">
				<tr>
					<td rowspan="3" width="100px;"><img style="width: 80px" src="<?= base_url() ?>assets/images/Logo_untad.png" /></td>
					<td style="font-size: 13px; margin-bottom: 0; padding-bottom: 0;  left: -80px; text-align: center;">
            <h5>
              <b>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</b>
            </h5>
					</td>
				</tr>
				<tr>
					<td style="font-size: 15; margin-top: 0; padding-top: 0; margin-bottom: 0; padding-bottom: 0;  left: -80px; text-align: center;">
          <h5>
						<b>UNIVERSITAS TADULAKO</b>
          </h5>
					</td>
				</tr>
				<tr>
					<td style="font-size: 15px; text-align: center; left: -80px;">
            <h6>
              <b>PROGRAM PERTUKARAN MAHASISWA MERDEKA DALAM NEGERI</b>
            </h6>
          </td>
				</tr>
			</table>
		</div>
		<hr>
		<div class="row">
			<div style="font-size: 14px; text-align: center; width: 100%;">
				KARTU RENCANA STUDI ( K.R.S. )<br>
				Semester <?= $periode; ?>
			</div>
		</div><br><br>
		<div class="row">
			<div class="col-md-12" style="font-size: 14px;">
				<table style="width: 100%">
					<tr>
						<td>NIM</td>
						<td>: <?= $profile->nim ?></td>
					</tr>
					<tr>
						<td>Nama Mahasiswa</td>
						<td>: <?= $profile->name ?></td>
					</tr>
					<tr>
						<td>Universitas Asal</td>
						<td>: <?= $profile->univ_asal ?></td>
					</tr>
					<tr>
						<td>Program Studi</td>
						<td>: <?= $profile->prodi_asal ?></td>
					</tr>
				</table>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<table class="table-mk" style="width: 100%">
					<tr>
						<th style="text-align: center;width: 1px">No.</th>
						<th style="text-align: center;">Program Studi</th>
						<th style="text-align: center;">Mata Kuliah</th>
						<th style="text-align: center;width: 60px">SKS(N)</th>
						<th style="text-align: center;width: 150px">Waktu</th>
						<th style="text-align: center;width: 60px">Ruang</th>
						<th style="text-align: center;width: 60px">Ket</th>
					</tr>
					<?php
						$n = 0;
						$TSKS = 0; 
						$TNK = 0;
						foreach ($detailKrs as $show) {
							$n++;
							//if ($show->Tunda == 'Y') $strtnd = "T : ".$show->AlasanTunda; else $strtnd = '&nbsp;';
         					//$bobot = 0;
         					//$bobot = $show->Bobot;
         					//$NK = $bobot * $show->SKS;

         					/*if($show->GradeNilai=="A"||$show->GradeNilai=="A-" ||$show->GradeNilai=="B+" ||$show->GradeNilai=="B" ||$show->GradeNilai=="B-"||$show->GradeNilai=="C+" ||$show->GradeNilai=="C"||$show->GradeNilai=="C-"||$show->GradeNilai=="D"||$show->GradeNilai=="E"||$show->GradeNilai=="K"||$show->GradeNilai=="T" ||$show->GradeNilai=="" ||$show->GradeNilai==" "){
								$TNK += $NK;*/
					        //}
							$prodi=$show->prodi;
							$MK=$show->NamaMK;
							$SKS = $show->SKS;
							$waktu = $show->waktu;
							$Ruang = $show->KodeRuang;
							$TSKS = $TSKS+$show->SKS;
					?>
						<tr>
							<td align="center"><?= $n; ?></td>
							<td><?= $prodi; ?></td>
							<td><?= $MK ?></td>
							<td align="center"><?= $SKS ?></td>
							<td align="center"><?= $waktu ?></td>
							<td align="center"><?= $Ruang ?></td>
							<td align="center"></td>
						</tr>
					<?php
						}
					?>
					<tr>
						<td align="right" colspan="3">Total :</td>
						<td align="center"><?= $TSKS; ?></td>
						<td colspan="2" align="center"></td>
						<td></td>
					</tr>
				</table>
			</div> 
		</div><br><br>

		<div class="row tandatangan">
			<table width="100%" style="margin-left: 600px; font-size: 20px;">
				<?php
				$tgl = date('d-m-Y');
				?>
				<tbody>
					<tr>
						<td style="width: 30%">Palu, <?= $tgl ?></td>
					</tr>
					<tr>
						<td style="width: 30%">Kepala BAKP Universitas Tadulako</td>
					</tr>
					<tr>
						<td style="width: 40%"></td>
						<td style="width: 30%"></td>
						<td style="width: 30%"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td style="height: 50"></td>
						<td></td>
					</tr>
					<tr>
						<td style="width: 500">Dr. Ir. H. Munari, S.T., M.M.<br>NIP 19650515 198603 1 006</td>
						<td style="height: 50"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>
