
<style>
  .dl-horizontal dt { 
    text-align: left;
  }
  .modal-dialog-full-width {
    position: absolute;
      width: 80% !important;
      height: 100% !important;
      margin: 0 !important;
      padding: 0 !important;
      max-width:none !important;

  }

  .modal-content-full-width  {
      height: auto !important;
      min-height: 100% !important;
      border-radius: 0 !important;
      background-color: #FBFCFC !important 
  }

  .modal-header-full-width  {
      border-bottom: 1px solid #9ea2a2 !important;
  }

  .modal-footer-full-width  {
      border-top: 1px solid #9ea2a2 !important;
  }
</style>

<div id="app" class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="row">
      <h1>Kartu Rencana Studi </h1>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('menu/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('ademik/').$_SESSION['tamplate'] ?>">KRS</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Form KRS</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Periode</label>
              <div class="col-sm-10">
                <select id="SelectTahunPeriode" name="SelectTahunPeriode" class="form-control">
                  <option value=''>Periode</option>
                  <?php foreach ($tahun_semester as $periode) {
                  echo "<option value='$periode->kode'>$periode->nama</option>";
                    
                  }?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="cariNim" class="col-sm-2 col-form-label">NIM</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <input 
                    type="text" 
                    value="<?= (isset($profile))? $profile->nim : "" ; ?>" 
                    class="form-control" 
                    list="listNim" 
                    id="cariNim"
                    <?= (isset($profile))? "Disabled" : "" ; ?>
                  >
                  <span id="loadSearch" style="display:none;"><img src="<?= base_url('assets/img/Spinner-1s-200px.gif') ?>"  width="50" height="50"/></span>
                </div>
                <datalist id="listNim">
                </datalist>
              </div>
            </div>
            
            <div id="profile" class="container callout callout-info row">
              <dl class="dl-horizontal pull-left">
                <dt>NIM</dt>
                <dd><input id="nim" disabled ></dd>
                
                <dt>Nama</dt>
                <dd><input id="nama" disabled ></dd>
                
                <dt>Universitas Asal</dt>
                <dd><input id="univAsal" disabled ></dd>
                
                <dt>Prodi Asal</dt>
                <dd><input id="proAsal" disabled ></dd>
                
                <dt>Total SKS</dt>
                <dd><input id="totalSKS" disabled ></dd>
                
              </dl>
            </div>
            
          </div>
          
          <!-- bagian KRS -->
          <div class="col-md-12 col-lg-8 ">
            

            <div class="box" id="boxTabelKrs" style="display: none;">
              <div class="box-header">
                <h3 class="box-title">KRS</h3>
                <h6 class="box-subtitle">Daftar matakuliah yang diambil</h6>
                <!-- <div class="float-right"> -->
                  
                  
                <!-- </div> -->
                <div class="row float-right">
                  <div class="btn-group">
                    
                  </div>
                  <div class="col-4">
                    <a type="button" class="btn btn-default float-right" data-toggle="modal" data-target="#exampleModalPreview"><i class="fa fa-plus"></i> Belanja KRS</a>
                  </div>
                  <div class="col-8">
                    <a  style="display: none;" id="dwnldKrs" class="btn btn-block btn-social btn-twitter float-right" href="<?= base_url('ademik/Krs_pmmdn/cetakKrs/'.$token) ?>"><i class="fa fa-download"></i> Download KRS</a>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div style="display: none;" id="tblKrs" class="box-body">
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
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
    </div>
  </section>
</div>

<!-- modal -->
<div class="modal fade right" id="exampleModalPreview" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
    <div class="modal-content-full-width modal-content ">
      <div class=" modal-header-full-width   modal-header text-center">
        <h5 class="modal-title w-100" id="exampleModalPreviewLabel">Belanja KRS</h5>
        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
          <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow:hidden;">

            <div class="row">
              <div class="col-12">
                <div class="form-group row">
                  <label for="pilihProdi" class="col-lg-2 col-form-label">Prodi</label>
                  <div class="col-lg-10">
                    <select id="pilihProdi" class="">
                      <option value="">=========================| Program Studi |=========================</option>
                      <?php foreach ($daftar_prodi as $prodi) {
                        echo "<option value='$prodi->kode'>$prodi->kode - $prodi->nama</option>";
                      }?>
                    </select>
                  </div>
                </div>
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
      <div class="modal-footer-full-width  modal-footer">
        
      </div>
    </div>
  </div>
</div>
<!-- /modal -->


