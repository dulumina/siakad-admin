<!DOCTYPE html>
<html>
<head>
	<title>Cetak Daftar Nilai</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/components/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<style type="text/css">
		body{
			font-family: Arial, Helvetica, sans-serif;
		}
		h2, h3{
			margin: 0px;
			padding: 0px;
		}
		.page-break {
			display: block;
			page-break-before: always;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<table style="width: 100%">
				<tr>
						<td rowspan="3" width="85px;"><img style="width: 100px" src="<?= base_url('/assets/Logo_untad.png')?>" /></td>
						<td style="font-size: 15px; margin-bottom: 0; padding-bottom: 0; margin-left: 20px; text-align: center;">
								<b>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</b>
						</td>
				</tr>
				<tr>
						<td style="font-size: 22; margin-top: 0; padding-top: 0; margin-bottom: 0; padding-bottom: 0; margin-left: 20px; text-align: center;">
								<b>UNIVERSITAS TADULAKO</b>
						</td>
				</tr>
				<tr>
					<td style="text-align: center; font-size: 13px;">
						<b style="font-size: 11"><?= strtoupper( $detailJadwal->nmf ); ?></b>
					</td>
				</tr>
		</table>
		<table style="width: 100%;">
				<tr>
						<td><div style="border-top: double 6px black;"></div></td>
				</tr>
		</table>
		<br>
		<div class="row">
			<div class="col-md-12" style="font-size: 12px;">
				<table class="text-center" style="width: 100%">
					<tr>
						<td>DAFTAR NILAI MAHASISWA</td>
					</tr>
					<tr>
						<td>Semester <?= $detailJadwal->namatahun ?></td>
					</tr>
				</table>
				<table style="width: 100%">
					<tr>
						<td>Mata Kuliah</td>
						<td>: <?= $detailJadwal->KodeMK." - ".$detailJadwal->MK."(".$detailJadwal->SKS.")" ?></td>
						<td>Program Studi</td>
						<td>: <?= $detailJadwal->nmj ?></td>
					</tr>
					<tr>
						<td>Dosen</td>
						<td>: <?= $detailJadwal->Dosen ?></td>
						<td>Kelas</td>
						<td>: <?= $detailJadwal->Keterangan ?></td>
					</tr>
					<?php foreach ($getAssDsn->result() as $AssDsn) { ?>
						<tr>
							<td></td>
							<td>: <?= $AssDsn->Name ?></td>
							<td></td>
							<td></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div><br><br>
		<div class="row">
			<div class="col-md-12" style="font-size: 12px;">

					<!--<tr>
						<th style="vertical-align: middle;text-align: center;" align="center">Angka</th>
						<th style="vertical-align: middle;text-align: center;" align="center">Huruf</th>
					</tr>-->
					<?php
					$num = 30;
					$a = 1;
					foreach ($detailMahasiswa as $mhsw){


						if ($a == 1 or $a == 31 or $a == 61 or $a == 91 or $a == 121){

						?>

						<table border="1" style="width: 100%">
							<tr>
								<th style="vertical-align: middle;text-align: center; width: 10px" align="center" rowspan="1">No.</th>
								<th style="vertical-align: middle;text-align: center; width: 80px" align="center" rowspan="1">NIM</th>
								<th style="vertical-align: middle;text-align: center;" align="center" rowspan="1">Nama Mahasiswa</th>
								<th style="vertical-align: middle;text-align: center; width: 60px" align="center" colspan="1">Kehadiran</th>
								<!--<th style="vertical-align: middle;text-align: center; width: 130px" align="center" colspan="2">Nilai</th>-->
								<th style="vertical-align: middle;text-align: center; width: 130px" align="center" colspan="1">Nilai Huruf</th>
								<!--<th style="vertical-align: middle;text-align: center; width: 120px" align="center" rowspan="1" colspan="2">TANDA TANGAN</th>-->
							</tr>

						<?php

						}

						$sum_kehadiran = 16;
						$kehadiran = 0;

						for ($int = 1; $int <= $sum_kehadiran; $int++){
							$hr_ke = "hr_".$int;
							if ($mhsw->$hr_ke == 'H'){
								$kehadiran++;
							}
						}

						$kehadiran = ($kehadiran/$sum_kehadiran) * 100;

					?>
						<tr>
							<td align="center"><?= $a ?></td>
							<td><?= $mhsw->NIM ?></td>
							<td><?= $mhsw->Name ?></td>
							<td align="center"><?= $kehadiran ?> %</td>
							<!-- <td align="center">A  A-  B+  B  B-  C  D  E</td> -->
							<td align="center"><?= $mhsw->GradeNilai ?></td>
							<!--<td align="center"><?= $mhsw->Bobot ?></td>-->
							<!--<td align="left"><?= $a ?>.</td>
							<td align="center"></td>-->
						</tr>
					<?php

						if ($a == 30 or $a == 60 or $a == 90 or $a == 120){

						echo "</table><div class='page-break'></div>";

						}

						$a++;
						$num = $num + 30;
						/*if ($a >= 26 and $a <= 50){
							echo '<div class="page-break"></div>';
						}*/
					}
					?>
					</table>
			</div>
		</div><br><br>
		<div class="row">
			<div class="col-md-8" style="display: block;">

			</div>
			<div class="col-md-4" style="display: block;">
				<?= $tempat.", ".$tglnow ?><br>
				Yang membuat,<br><br><br><br>
				<?php
				if (!empty($detailJadwal->Dosen)){
				?>
					<?= $detailJadwal->Dosen ?><br><?= $detailJadwal->nipdosen ?>
				<?php
				} else {
				?>
					( ............................ )
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<script>
		window.print();
	</script>
</body>
</html>
