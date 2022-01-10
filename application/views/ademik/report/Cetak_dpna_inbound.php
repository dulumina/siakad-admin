<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Cetak DPNA</title>
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
        DPNA
        <br>Semester <?= $per->nama_periode; ?>

      </div>
    </div>
    <br><br>
    <div class="row" style="margin-bottom: 13px;">
      <div class="col-md-12" style="font-size: 15px;">
        <table style="width: 100%">
          <tr>
            <td style="width: 100px;">Mata Kuliah</td>
            <td>: <?= $data_dpna[0]->NamaMK ?></td>
          </tr>
          <tr>
            <td>Fakultas</td>
            <td>: <?= $data_dpna[0]->Nama_indonesia ?></td>
          </tr>
          <tr>
            <td>Program Studi</td>
            <td>: <?= $data_dpna[0]->prodi ?></td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td>: <?= $data_dpna[0]->Keterangan ?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" style="font-size: 13px;">
        <table border="1" style="border: 1px solid black; width: 100%">
          <tr>
            <th style="width: 1px; text-align: center;" align="center">No.</th>
            <th style="width: 1px; text-align: center;" align="center">NIM</th>
            <th style="width: 1px; text-align: center;" align="center">Nama</th>
            <th style="width: 1px; text-align: center;" align="center">Asal Universitas</th>
            <!-- <th style="width: 1px; text-align: center;" align="center">Asal Prodi</th> -->
            <th style="width: 20px; text-align: center;" align="center">Kehadiran</th>
            <th style="width: 20px; text-align: center;" align="center">Tugas</th>
            <th style="width: 50px; text-align: center;" align="center">UTS</th>
            <th style="width: 50px; text-align: center;" align="center">UAS</th>
            <th style="width: 50px; text-align: center;" align="center">Nilai</th>
          </tr>
          <?php
          $n = 0;
          $TSKS = 0;
          $IPS = 0;
          $IP = 0;
          foreach ($data_dpna as $dpna1) {
            $n++;
            // $TSKS = $TSKS + $dpna1->SKS;
            // $IP = $IP + $dpna1->nilai;
            // $IPS = $IP / $TSKS;
          ?>
            <tr>
              <td align="center"><?= $n; ?></td>
              <td><?= $dpna1->nim; ?></td>
              <td><?= $dpna1->name; ?></td>
              <td><?= $dpna1->univ_asal; ?></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
    <br>



    <div class="row tandatangan">
      <table width="100%" style="margin-left: 1200px; font-size: 20px;">
        <?php
        $tgl = date('d-m-Y');
        ?>
        <tbody>
          <tr>
            <td style="width: 30%">Palu, <?= $tgl ?></td>
          </tr>
          <tr>
            <td style="width: 30%">Dosen Penanggung Jawab</td>
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
            <td style="width: 500"><?= $data_dpna[0]->namadosen ?><br>NIP <?= $data_dpna[0]->IDDosen ?></td>
            <td style="height: 50"></td>
          </tr>
        </tbody>
      </table>
    </div>




  </div>

</body>

</html>