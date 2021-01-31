<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.pointer {cursor: pointer;}
</style>
<div class="content-wrapper">

  <section class="content-header">
    <h4 class="box-title"><i class="fa fa-users"></i> Update Status Feeder </h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="breadcrumb-item"><a href="#">Mahasiswa</a></li>
      <li class="breadcrumb-item active">Perwalian Mahasiswa</li>
    </ol>
  </section>

  <section class="content row " style="padding-bottom: 0;">
    <div class="col-md-3">
      <div class="box box-default tabel_mahasiswa">
        <div class="box-header">
          <h5 class='fa-hover '> Perbandingan siakad </h5>
        </div>

        <div class="box-body">

          <div class="row">
            <div class="col-md-12 col-xs-12 ">

              <table id="table_mahasiswa_wali" class="table table-striped table-responsive nowrap">
                <thead>
                  <tr>
                    <th class="fixed-column">#</th>
                    <th class="fixed-column">on Siakad</th>
                    <th class="fixed-column">Jumlah</th>
                  </tr>
                </thead>

                <tbody>
                <?php foreach($on_siakad as $row): ?>
                  <tr>
                    <td> # </td>
                    <td> <?= $row->on_siakad ?> </td>
                    <td> <?= $row->jumlah ?> </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="fixed-column">#</th>
                    <th class="fixed-column">on Siakad</th>
                    <th class="fixed-column">Jumlah</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="box box-default tabel_mahasiswa">
        <div class="box-header">
          <h5 class='fa-hover '> Update Status Feeder </h5>
        </div>

        <div class="box-body">

          <div class="row">
            <div class="col-md-12 col-xs-12 ">

              <table id="table_mahasiswa_wali" class="table table-striped table-responsive nowrap">
                <thead>
                  <tr>
                    <th class="fixed-column">#</th>
                    <th class="fixed-column">status Siakad</th>
                    <th class="fixed-column">Jumlah</th>
                  </tr>
                </thead>

                <tbody>
                <?php foreach($status as $row): ?>
                  <tr>
                    <td> # </td>
                    <td> <?= $row->status_siakad ?> </td>
                    <td> <a class="pointer text-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $row->status_siakad ?>"> <?= $row->jumlah ?> </a> </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="fixed-column">#</th>
                    <th class="fixed-column">status Siakad</th>
                    <th class="fixed-column">Jumlah</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-default tabel_mahasiswa">
        <div class="box-header">
          <h5 class='fa-hover '> Log Process </h5>
        </div>

        <div class="box-body">

          <div class="row">
            <div class="col-md-12 col-xs-12 ">

              <table id="log" class="table table-striped table-responsive nowrap">
                <thead>
                  <tr>
                    <th class="fixed-column">#</th>
                    <th class="fixed-column">nim</th>
                    <th class="fixed-column">report</th>
                  </tr>
                </thead>

                <tbody>
                
                </tbody>
                <tfoot>
                  <tr>
                    <th class="fixed-column">#</th>
                    <th class="fixed-column">nim</th>
                    <th class="fixed-column">report</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prosess</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenis Keluar:</label>
            <select name="jenisKeluar" id="jk" required>
              <?php foreach($jenisKeluar as $row): ?>
                <option value="<?= $row->id_jenis_keluar ?>"><?= $row->jenis_keluar ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Tanggal Keluar</label>
            <input type="date" name="tanggalKeluar" id="tk" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Periode Keluar</label>
            <select name="idPeriodeKeluar" id="pk" required>
                <option value="20191">Ganjil 2019/2020</option>
                <option value="20192">Genap 2019/2020</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Keterangan</label>
            <textarea name="keterangan" id="ket"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="prc" class="btn btn-primary">Proses</button>
      </div>
    </div>
  </div>
</div>