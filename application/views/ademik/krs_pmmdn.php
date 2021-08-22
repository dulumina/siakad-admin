
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="row">
      <h1>KRS </h1>
      <div class="col-2">
        <select id="SelectTahunPeriode" name="SelectTahunPeriode" class="form-control">
          <option >Periode</option>
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
                  <label for="example-search-input" class="col-sm-2 col-form-label">Prodi</label>
                  <div class="col-sm-10">
                    <select class="form-control">
                      <option>Program Studi</option>
                      <?php foreach ($daftar_prodi as $prodi) {
                      echo "<option value='$prodi->kode'>$prodi->nama</option>";
                        
                      }?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-text-input" class="col-sm-2 col-form-label">Matakuliah</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" value="Johen Doe" id="example-text-input">
                  </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <table class="table table-responsive">
              <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Matakuliah</th>
                  <th>Peserta Kelas</th>
                  <th style="width: 40px">Ambil</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Update software</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-primary" style="width: 55%"></div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <div class="checkbox">
                          <input type="checkbox" id="Checkbox_1">
                          <label for="Checkbox_1"></label>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Clean database</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-success" style="width: 70%"></div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <div class="checkbox">
                          <input type="checkbox" id="Checkbox_2">
                          <label for="Checkbox_2"></label>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Cron job running</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-red" style="width: 30%"></div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <div class="checkbox">
                          <input type="checkbox" id="Checkbox_3">
                          <label for="Checkbox_3"></label>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-warning" style="width: 90%"></div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <div class="checkbox">
                          <input type="checkbox" id="Checkbox_4">
                          <label for="Checkbox_4"></label>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-12 col-lg-6">
        

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">KRS <?= $_SESSION['periode'];?></h3>
            <h6 class="box-subtitle">Daftar matakuliah yang diambil</h6>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-hover table-responsive">
              <tbody><tr>
                <th style="width: 10px">#</th>
                <th>Products</th>
                <th>Popularity</th>
                <th style="width: 40px">Sales</th>
              </tr>
              <tr>
                <td>1.</td>
                <td>Milk Powder</td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-info" style="width: 55%"></div>
                  </div>
                </td>
                <td><span class="badge bg-blue">55%</span></td>
              </tr>
              <tr>
                <td>2.</td>
                <td>Air Conditioner</td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-red" style="width: 70%"></div>
                  </div>
                </td>
                <td><span class="badge bg-red">70%</span></td>
              </tr>
              <tr>
                <td>3.</td>
                <td>RC Cars</td>
                <td>
                  <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar progress-bar-yellow" style="width: 30%"></div>
                  </div>
                </td>
                <td><span class="badge bg-yellow">30%</span></td>
              </tr>
              <tr>
                <td>4.</td>
                <td>Down Coat</td>
                <td>
                  <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                  </div>
                </td>
                <td><span class="badge bg-green">90%</span></td>
              </tr>
            </tbody></table>
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