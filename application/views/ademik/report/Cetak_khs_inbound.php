<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cetak KHS</title>
	<link rel="stylesheet" type="text/css" href="./assets/components/bootstrap/dist/css/bootstrap.min.css">
	<style type="text/css">
		body {
			font-family: times;
		}

		h2,
		h3 {
			margin: 0px;
			padding: 0px;
		}

		.page-break {
			display: block;
			page-break-before: always;
		}

		.ttd_container {
			display: flex;
			justify-content: space-between;
			background-color: blue;
		}

		.ttd_container>div {
			background-color: black;

		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row" style="font-size: 12px; padding-bottom: 12px">
			<div class="col-md-12" style="font-size: 14px;">
				<table style="width: 100%">
					<tr>
						<th style="vertical-align:middle; text-align: center;width: 5px">
							<img style="width: 100px" src="./assets/Logo_untad.png">
						</th>
						<th style="vertical-align:middle; text-align: center;" class="col-md-11 text-center">
							<h4><b>
									KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI
								</b></h4>
							<h3><b>
									UNIVERSITAS TADULAKO
								</b></h3>
							<h4>

							</h4>
						</th>
					</tr>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 text-center" style="font-size: 17px; font-weight: bold;">
				KARTU HASIL STUDI
				<br>Semester <?= $per->nama_periode; ?>

			</div>
		</div>
		<br><br>
		<div class="row" style="margin-bottom: 13px;">
			<div class="col-md-12" style="font-size: 15px;">
				<table style="width: 100%">

					<tr>
						<td>NIM</td>
						<td>: <?= $mhs->nim ?></td>
						<td>Universitas Asal</td>
						<td>: <?= $mhs->univ_asal ?> </td>
					</tr>
					<tr>

						<td>Nama Mahasiswa</td>
						<td>: <?= $mhs->name ?></td>
						<td>Prodi Asal</td>
						<td>: <?= $mhs->prodi_asal ?> </td>
					</tr>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12" style="font-size: 13px;">
				<table border="1" style="border: 1px solid black; width: 100%">
					<tr>
						<th style="width: 1px; text-align: center;" align="center">No.</th>
						<th style="width: 1px; text-align: center;" align="center">Kode MK</th>
						<th style="width: 1px; text-align: center;" align="center">Mata Kuliah</th>
						<th style="width: 50px; text-align: center;" align="center">SKS</th>
						<th style="width: 60px; text-align: center;" align="center">Nilai</th>
					</tr>
					<?php
					$n = 0;
					$TSKS = 0;
					$IPS = 0;
					$IP = 0;
					$bobot = 0;
					foreach ($data_khs as $khs1) {
						$n++;
						$gradenilai = $khs1->GradeNilai;

						if ($gradenilai == 'A') {
							$bobot = 4.00 * $khs1->SKS;
						} elseif ($gradenilai == 'A-') {
							$bobot = 3.75 * $khs1->SKS;
						} elseif ($gradenilai == 'B+') {
							$bobot = 3.50 * $khs1->SKS;
						} elseif ($gradenilai == 'B') {
							$bobot = 3.00 * $khs1->SKS;
						} elseif ($gradenilai == 'C') {
							$bobot = 2.50 * $khs1->SKS;
						} elseif ($gradenilai == 'D') {
							$bobot = 1.00 * $khs1->SKS;
						} elseif ($gradenilai == 'E') {
							$bobot = 0 * $khs1->SKS;
						}

						$TSKS = $TSKS + $khs1->SKS;
						$IP = $IP + $bobot;
						$IPS = $IP / $TSKS;
					?>
						<tr>
							<td align="center"><?= $n; ?></td>
							<td><?= $khs1->KodeMK; ?></td>
							<td><?= $khs1->NamaMK; ?></td>
							<td align="center"><?= $khs1->SKS; ?></td>

							<td align="center"><?= $khs1->GradeNilai; ?></td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
		<br>

		<div class="row" style="margin-bottom: 13px;">
			<div class="col-md-12" style="font-size: 15px;">
				<table style="width: 25%">
					<tr>
						<td>IP Semester</td>
						<td>: <?= round($IPS, 2) ?></td>
					</tr>
					<tr>
						<td>SKS Semester</td>
						<td>: <?= $TSKS ?> </td>
					</tr>
				</table>
			</div>
		</div>


		<div class="row tandatangan">
			<table width="100%" style="margin-left: 540px; font-size: 20px;">
				<?php
				$tgl = date('d-m-Y');
				?>
				<tbody>
					<tr>
						<td style="padding-left: 100px; width: 30%">Palu, <?= $tgl ?></td>
					</tr>
					<tr>
						<td style="padding-left: 100px; width: 80%">Kepala BAKP Universitas Tadulako</td>
					</tr>
					<tr>
						<td><img style="width: 400px;" src="./assets/baru.png"></td>
						<td style="width: 40%"></td>
						<td style="width: 30%"></td>
						<td style="width: 30%"></td>
						<td></td>
					</tr>
					<!-- <tr>
						<td></td>

						<td style="height: 50"></td>
						<td></td>
					</tr>
					<tr>
						<td style="width: 500">Dr. Ir. H. Munari, S.T., M.M.<br>NIP 19650515 198603 1 006</td>
						<td style="height: 50"></td>
					</tr> -->
				</tbody>
			</table>
		</div>




	</div>

</body>

</html>