
      <div class="row">
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-blue">
            <span class="info-box-icon push-bottom"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumal Mahasiswa</span>
              <span class="info-box-number"><?= $countMhs; ?> Orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    <?= "Aktif $countMhsAktif, Cuti $countMhsCuti dan Unregist $countMhsUnregist"?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-green">
            <span class="info-box-icon push-bottom"><i class="ion ion-ios-pricetags-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">MAHASISWA MEMBAYAR </span>
              <span class="info-box-number"><?= $countMhsBayar; ?> Orang </span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= ($countMhsBayar/$countMhs*100) ?>%"></div>
              </div>
              <span class="progress-description">
                    Mahasiswa yang membayar UKT <?= $periode; ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-purple">
            <span class="info-box-icon push-bottom"><i class="ion ion-ios-paper-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">MAHASISWA BERKRS </span>
              <span class="info-box-number"><?= $countMhsKrs; ?> Orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= ($countMhsKrs/$countMhs*100) ?>%"></div>
              </div>
              <span class="progress-description">
                    Mahasiswa berKRS <?= $periode; ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-red">
            <span class="info-box-icon push-bottom"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tahun Akademik <?= $periode;?> </span>
              <span class="info-box-number">KHS Terkirim</span>

              <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
              </div>
              <span class="progress-description">
                    KHS Terkirim Ke DIKTI
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>