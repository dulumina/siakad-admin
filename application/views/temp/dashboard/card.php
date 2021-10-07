
      <div class="row">
        <div class="col-xl-2 col-md-4 col">
          <div class="info-box bg-blue">
            <span class="info-box-icon push-bottom"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumal Mahasiswa</span>
              <span class="info-box-number"><?= $countMhs; ?> Orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                <marquee><?= "Aktif $countMhsAktif, Cuti $countMhsCuti dan Unregist $countMhsUnregist"?></marquee>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-2 col-md-4 col">
          <div class="info-box bg-green">
            <span class="info-box-icon push-bottom"><i class="ion ion-ios-pricetags-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">MEMBAYAR </span>
              <span class="info-box-number"><?= $countMhsBayar; ?> Orang </span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= ($countMhsBayar/$countMhs*100) ?>%"></div>
              </div>
              <span class="progress-description">
                <marquee>Mahasiswa yang membayar UKT <?= $periode; ?></marquee>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-2 col-md-4 col">
          <div class="info-box bg-purple">
            <span class="info-box-icon push-bottom"><i class="ion ion-ios-paper-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">BERKRS </span>
              <span class="info-box-number"><?= $countMhsKrs; ?> Orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= ($countMhsKrs/$countMhs*100) ?>%"></div>
              </div>
              <span class="progress-description">
                <marquee> Mahasiswa berKRS <?= $periode; ?></marquee>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-2 col-md-4 col">
          <div class="info-box bg-orange">
            <span class="info-box-icon push-bottom"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inbound </span>
              <span class="info-box-number"><?= $countMhsinbon ?> Orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                <marquee>Jumlah Mahasiswa Inbound</marquee>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-2 col-md-4 col">
          <div class="info-box bg-green">
            <span class="info-box-icon push-bottom"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Dosen </span>
              <span class="info-box-number"><?= $countDosen ?> Orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                <marquee>Jumlah Dosen</marquee>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-2 col-md-4 col">
          <div class="info-box bg-yellow">
            <span class="info-box-icon push-bottom"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Matakuliah </span>
              <span class="info-box-number"><?= $countMK ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                <marquee>Jumlah matakuliah</marquee>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
