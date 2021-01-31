<style>
.pointer {cursor: pointer;}
</style>
<div class="content-wrapper">

  <section class="content-header">
    <h4 class="box-title"><i class="fa fa-users"></i> Mahasiswa Wali</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="breadcrumb-item"><a href="#">Mahasiswa</a></li>
      <li class="breadcrumb-item active">Perwalian Mahasiswa</li>
    </ol>
  </section>

  <section class="content row " style="padding-bottom: 0;">
    <div class="box box-default tabel_mahasiswa">
      <div class="box-header">
        <h5 class='fa-hover '> Daftar Mahasiswa wali semester aktif ( 
          <span id="periode">
            <?php if(!empty($periode)){ ?>
            <select name="tahunPeriode" id="tahunPeriode">
              <?php foreach ($periode as $tahunPeriode) : ?>
                <option value="<?= $tahunPeriode->Kode ?>" <?= $tahunPeriode->selected ?> ><?= $tahunPeriode->Nama ?></option>
              <?php endforeach; ?>
            </select>
            <?php }else{echo "Tida ada periode aktif, hubungi admin untuk periode ber KRS";}?>
          </span>  
          ) 
        </h5>
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-md-12 col-xs-12 ">

            <table id="table_mahasiswa_wali" class="table table-striped table-responsive nowrap">
              <thead>
                <tr>
                  <th class="fixed-column">#</th>
                  <th class="fixed-column">NIM</th>
                  <th class="fixed-column">Angkatan</th>
                  <th class="fixed-column">Nama</th>
                  <th class="fixed-column">Status</th>
                  <th class="fixed-column">SKS</th>
                  <th class="fixed-column">validasi</th>
                </tr>
              </thead>

              <tbody>
                <?php $no=1; foreach($listMhsw as $mhsw) : ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $mhsw->nim ?></td>
                  <td><?= $mhsw->angkatan ?></td>
                  <td><?= $mhsw->name ?></td>
                  <td><?= $mhsw->status ?></td>
                  <td><?= $mhsw->sks ?></td>
                  <td>
                    <button class="btn btn-warning" data-nim="<?= $mhsw->nim ?>" data-toggle="modal" data-target="#mhswMk" ><i class="fa fa-copy"></i> Lihat Matakuliah</button>
                  </td>
                </tr>
                <?php $no++; endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="fixed-column">#</th>
                  <th class="fixed-column">NIM</th>
                  <th class="fixed-column">Angkatan</th>
                  <th class="fixed-column">Nama</th>
                  <th class="fixed-column">Status</th>
                  <th class="fixed-column">SKS</th>
                  <th class="fixed-column">validasi</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

      <form id="myform">
        <div class="modal fade bs-example-modal-lg form_mahasiswa_wali" tabindex="-1" role="dialog"
          aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">

            <div class="modal-content">

              <div class="modal-header" style="margin: 0px">
                <h5 class="modal-title" id="myLargeModalLabel"> <i class="fa fa-book"></i>  Detail Matakuliah yang diambil</h5>
              </div>

              <div class="modal-body" style="padding-top: 0px">
                <div id="modal_mahasiswa_wali"></div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect text-center pull-right col-md-12"
                  data-dismiss="modal" onclick="load_tabel_mahasiswa_wali()"><i class="fa fa-save"></i>
                  Simpan</button>
              </div>

            </div>
          </div>
        </div>
      </form>

    </div>

  </section>
  <div class="modal fade bd-example-modal-lg" id="mhswMk" tabindex="-1" role="dialog" aria-labelledby="Krs Mahasiswa" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <table id="table_mahasiswa_wali" class="table table-striped table-responsive nowrap">
            <thead>
              <tr>
                <th class="fixed-column">Kode MK</th>
                <th class="fixed-column">Matakuliah</th>
                <th class="fixed-column">SKS</th>
                <th class="fixed-column">Status</th>
              </tr>
            </thead>
            <tbody id="tbmk">
            
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>

</div>
