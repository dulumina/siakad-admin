
<style>
  .dl-horizontal dt { 
    text-align: left;
  }
</style>

<div id="app" class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="row">
      <h1>KRS </h1>
      <div class="col-2">
        <select id="SelectTahunPeriode" name="SelectTahunPeriode" class="form-control">
          <option value=''>Periode</option>
          <?php foreach ($tahun_semester as $periode) {
          echo "<option value='$periode->kode'>$periode->nama</option>";
            
          }?>
        </select>
      </div>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('menu/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('ademik/').$_SESSION['tamplate'] ?>">KRS</a></li>
    </ol>
  </section>
  <?php if(isset($this->TahunPeriode)) { ?>
  <section id="content" class="content">
    <div class="row">
      <div class="col-md-12 col-lg-6">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Belanja Matakuliah</h3>
            <h6 class="box-subtitle">Formulir belanja matakuliah</h6>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group row">
                  <label for="pilihProdi" class="col-sm-2 col-form-label">Prodi</label>
                  <div class="col-sm-10">
                    <select id="pilihProdi" class="form-control">
                      <option value="">Program Studi</option>
                      <?php foreach ($daftar_prodi as $prodi) {
                        echo "<option value='$prodi->kode'>$prodi->kode - $prodi->nama</option>";
                      }?>
                    </select>
                  </div>
                </div>
                <!-- <div class="form-group row">
                  <label for="cariMk" class="col-sm-2 col-form-label">Matakuliah</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" value="" id="cariMk" disabled>
                  </div>
                </div> -->
              </div>
              <!-- /.col -->
            </div>
            <table id="jadwal" class="table table-responsive">
              <thead>
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Matakuliah</th>
                  <th>Hari</th>
                  <th>Ruangan</th>
                  <th style="width: 10px">SKS</th>
                  <th style="width: 10px">Ambil</th>
                </tr>
              </thead>
              <tbody id="tbody-kelas">
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->

      <!-- bagian KRS -->
      <div class="col-md-12 col-lg-6">
        

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">KRS <?= $_SESSION['periode'];?></h3>
            <h6 class="box-subtitle">Daftar matakuliah yang diambil</h6>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="container callout callout-success row">
              <dl class="dl-horizontal pull-left">
                <dt>NIM</dt>
                <dd><input value="<?= $profile->nim ?>" id="nim" disabled ></dd>
                
                <dt>Nama</dt>
                <dd><input value="<?= $profile->name ?>" id="nama" disabled ></dd>
                
                <dt>Universitas Asal</dt>
                <dd><input value="<?= $profile->univ_asal ?>" id="univAsal" disabled ></dd>
                
                <dt>Prodi Asal</dt>
                <dd><input value="<?= $profile->prodi_asal ?>" id="proAsal" disabled ></dd>
                
                <dt>Total SKS</dt>
                <dd><input value="<?= $totalSKS ?>" id="totalSKS" disabled ></dd>
                
              </dl>
            </div>
            
            <div class="pull-right">
              <a class="btn btn-block btn-social btn-twitter" href="<?= base_url('ademik/Krs_pmmdn/cetakKrs/'.$token) ?>"><i class="fa fa-download"></i> Download KRS</a>
            </div><br>
            <hr>
            <table id="krs" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Matakuliah</th>
                  <th>SKS</th>
                  <th>Program Studi</th>
                  <th>Ruang</th>
                  <th>Waktu</th>
                  <th>action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>NO</th>
                  <th>Matakuliah</th>
                  <th>SKS</th>
                  <th>Program Studi</th>
                  <th>Ruang</th>
                  <th>Waktu</th>
                  <th>action</th>
                </tr>
              </tfoot>
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
  </section>
  <?php }else{ ?>
  <?php } ?>
</div>
