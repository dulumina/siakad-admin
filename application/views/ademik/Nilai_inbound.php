<script>
  wait$(() => {


    $('#dosen').change(function() {
      var id = $("#dosen").val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url() ?>ademik/Nilai_inbound/mata_kuliah',
        data: {
          id: id
        },
        success: function(data) {
          let matkul = JSON.parse(data);
          console.log(matkul);
          var html = '';
          var i;
          for (i = 0; i < matkul.length; i++) {
            html += '<option value=' + matkul[i].KodeMK + '>' + matkul[i].NamaMK + '</option>';
          }
          $('#mk').html(html);
        }
      });
    });

    $(document).ready(function() {
      $('#hadir, #praktek, #mid, #uas, #tugas, #jml_nilai').change(function() {
        let hadir = $("#hadir").val();
        let praktek = $("#praktek").val();
        let mid = $("#mid").val();
        let uas = $("#uas").val();
        let season = $("#season").val();
        let tugas = $("#tugas").val();
        // console.log(season);
        let jml_nilai = $("#jml_nilai").val();
        let total = '';
        if (season == 'C') {
          let j_tugas = tugas * 0.25;
          let j_mid = mid * 0.35;
          let j_uas = uas * 0.4;
          let total = j_tugas + j_mid + j_uas;
          if (total >= 85.00 && total <= 100.00) {
            $("#grade").val('A');
          } else if (total >= 80.00 && total <= 90.99) {
            $("#grade").val('A-');
          } else if (total >= 80.00 && total <= 84.99) {
            $("#grade").val('B+');
          } else if (total >= 72.00 && total <= 79.99) {
            $("#grade").val('B');
          } else if (total >= 65.00 && total <= 71.99) {
            $("#grade").val('B-');
          } else if (total >= 58.00 && total <= 64.99) {
            $("#grade").val('C');
          } else if (total >= 45.00 && total <= 57.99) {
            $("#grade").val('D');
          } else if (total >= 0 && total <= 44.99) {
            $("#grade").val('E');
          }

        } else {
          total = jml_nilai;
          if (total >= 85.00 && total <= 100.00) {
            $("#grade").val('A');
          } else if (total >= 80.00 && total <= 90.99) {
            $("#grade").val('A-');
          } else if (total >= 80.00 && total <= 84.99) {
            $("#grade").val('B+');
          } else if (total >= 72.00 && total <= 79.99) {
            $("#grade").val('B');
          } else if (total >= 65.00 && total <= 71.99) {
            $("#grade").val('B-');
          } else if (total >= 58.00 && total <= 64.99) {
            $("#grade").val('C');
          } else if (total >= 45.00 && total <= 57.99) {
            $("#grade").val('D');
          } else if (total >= 0 && total <= 44.99) {
            $("#grade").val('E');
          }
        }
      });
    });

    $(document).ready(function() {
      $('#jml_nilai').change(function() {
        console.log("masuk nilai");
        // let hadir = $("#hadir").val();
        // let praktek = $("#praktek").val();
        // let mid = $("#mid").val();
        // let uas = $("#uas").val();
        // let j_hadir = hadir * 0.1;
        // let j_praktek = praktek * 0.2;
        // let j_mid = mid * 0.35;
        // let j_uas = uas * 0.35;
        // let total = j_hadir + j_praktek + j_mid + j_uas;
        // $("#grade").val('masuk');

      });
    });



    $(document).ready(function() {
      $('#submit').click(function() {
        let tahunakademik = $("#tahunakademik").val();
        let dosen = $("#dosen").val();
        let mk = $("#mk").val();
        $.ajax({
          type: 'POST',
          url: '<?= base_url() ?>ademik/Nilai_inbound/t_krs',
          data: {
            dosen: dosen,
            tahunakademik: tahunakademik,
            mk: mk
          },
          success: function(tes) {
            let res = JSON.parse(tes);
            console.log(res);
            rendernilai(res.data);
            $("#m_periode").val(tahunakademik);
            $("#m_mk").val(mk);
            $("#m_dosen").val(dosen);
          }
        });
      });
    });



    $(document).ready(function() {
      $('#save').click(function() {

        let id = $("#id").val();
        let hadir = $("#hadir").val();
        let praktek = $("#praktek").val();
        let mid = $("#mid").val();
        let uas = $("#uas").val();
        let nilai = $("#jml_nilai").val();
        let grade = $("#grade").val();
        let tugas = $("#tugas").val();

        $.ajax({
          type: 'POST',
          url: '<?= base_url() ?>ademik/Nilai_inbound/simpan_nilai',
          data: {
            id: id,
            hadir: hadir,
            praktek: praktek,
            tugas: tugas,
            mid: mid,
            uas: uas,
            nilai: nilai,
            grade: grade
          },
          success: function(tes) {
            let save = JSON.parse(tes);
            console.log("Sukses");
            alert_table("Nilai Berhasil Tersimpan");

            // location.reload();
            $('#modal-lg').modal('hide');
            go();
          }





        });




      });
    });


  })

  // function alert_error($error) {
  //   swal("Error", $error, "error");
  // };
</script>


<script type="text/javascript">
  function go() {
    let tahunakademik = $("#tahunakademik").val();
    let dosen = $("#dosen").val();
    let mk = $("#mk").val();
    $.ajax({
      type: 'POST',
      url: '<?= base_url() ?>ademik/Nilai_inbound/t_krs',
      data: {
        dosen: dosen,
        tahunakademik: tahunakademik,
        mk: mk
      },
      success: function(tes) {
        let res = JSON.parse(tes);
        console.log(res);
        rendernilai(res.data);
        console.log("Masuk GO");

      }
    });

  }



  function rendernilai(params) {
    let nilai = $('#nilai').DataTable();
    nilai.clear();
    nilai.destroy();
    nilai = $('#nilai').DataTable({
      data: params,
      columns: [{
          data: 'nim'
        },
        {
          data: 'name'
        },
        {
          data: 'tahun'
        },
        {
          data: 'NamaMK'
        },
        {
          data: 'nilai'
        },
        {
          data: 'id'
        },
      ],
      columnDefs: [{
        targets: 5,
        render: function(data, type, row, meta) {
          return '<button type="button"  onclick=in_nilai("' + row.id + '") class="add btn btn-circle btn-sm"  id="input" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-pencil"></i></button>';
        },
      }],
    }).draw();
    document.getElementById("cetak_dpna").disabled = false;
  }


  function in_nilai(ini) {
    let id = ini;
    let aa = 'bair';
    // console.log(id);
    $('#form-admin')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.form-group').removeClass('has-success');
    // $('.help-block').empty();
    $('#modal-lg').modal('show');
    $('.modal-title').text('Input Nilai');
    $.ajax({
      type: 'POST',
      url: '<?= base_url() ?>ademik/Nilai_inbound/in_nilai',
      data: {
        id: id
      },
      success: function(ini_nilai) {
        let res = JSON.parse(ini_nilai);
        console.log(res);


        $("#id").val(res.id);
        $("#nama_mhs").val(res.name);
        $("#nim").val(res.nim);
        $("#matkul").val(res.NamaMK);
        $("#hadir").val(res.JmlHadir);
        $("#praktek").val(res.NilaiPraktek);
        $("#tugas").val(res.NilaiTugas);
        $("#mid").val(res.NilaiNID);
        $("#uas").val(res.NilaiUjian);
        $("#jml_nilai").val(res.nilai);
        // $("#nilai").val(res.nilai);
        $("#grade").val(res.GradeNilai);

        $('#modal-lg').modal('show');
        $('.modal-title').text('Input Nilai Mahasiswa');
      }
    });

  }

  function alert_table($pesan) {
    swal({
      title: "Sukses",
      text: $pesan,
      type: "success"
    })
  };

  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Input Nilai Mahasiswa Inbound
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Mahasiswa Inbound</a></li>
      <li class="breadcrumb-item"><a href="<?= $_SESSION['tamplate'] ?>"> Input Nilai</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Input Nilai Mahasiswa</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="card card-default">
              <div class="card-header">

              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label>TahunAkademik</label>
                      <?php
                      $fakul = $this->session->userdata('kdf');
                      ?>
                      <input style="width: 100%;" type="text" class="form-control" id="tahunakademik" name="tahunakademik" placeholder="Tahun Akademik" value="" onkeypress="return hanyaAngka(event)" />
                      <input type="hidden" id="season" name="season" value="<?= $fakul ?>">
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label>Nama - NIP Dosen</label>
                      <select class="form-control select2 dosen" style="width: 100%;" id="dosen" name="dosen">
                        <option>--Pilih Dosen--</option>
                        <?php foreach ($dsn as $dosen) {
                          echo "<option value='$dosen->IDDosen'>$dosen->Name - $dosen->IDDosen</option>";
                        } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label>Mata Kuliah</label>
                      <select class="form-control select2" style="width: 100%;" id="mk" name="mk">

                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label>Tekan Tombol Go Merefresh</label>
                      <span class="input-group-btn">
                        <input type="submit" id="submit" name="submit" class="btn btn-info btn-flat" value="Go!" />
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer"></div>
            </div>

            <div class="card card-default">
              <div class="card-header">
                <form action="<?= base_url() ?>ademik/Nilai_inbound/Cetak_dpna" method="get">
                  <input type="hidden" id="m_periode" name="m_periode">
                  <input type="hidden" id="m_dosen" name="m_dosen">
                  <input type="hidden" id="m_mk" name="m_mk">
                  <button class="btn btn-flat btn-info" id="cetak_dpna" style="float: right;" disabled><i class="fa fa-print"></i> Cetak DPNA</button>
                </form>
              </div>
              <div class="card-body">
                <table id="nilai" class="table table-bordered table-striped">
                  <thead>
                    <tr style="text-align: center;">
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Tahun</th>
                      <th>Mata Kuliah</th>
                      <th>Nilai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Tahun</th>
                      <th>Mata Kuliah</th>
                      <th>Nilai</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>


          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->


  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Nilai</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" id="form-admin" class="form-horizontal">

            <div class="card card-default">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <input style="width: 100%;" type="hidden" class="form-control" id="id" name="id" />
                    <div class="form-group">
                      <label>Nama Mahasiswa</label>
                      <input style="width: 100%;" type="text" class="form-control" id="nama_mhs" name="nama_mhs" placeholder="Nama Mahasiswa" readonly />
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label>NIM</label>
                      <input style="width: 100%;" type="text" class="form-control" id="nim" name="nim" placeholder="NIM" readonly />
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label>Mata Kuliah</label>
                      <input style="width: 100%;" type="text" class="form-control" id="matkul" name="matkul" placeholder="Mata Kuliah" readonly />
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="card card-default">
              <div class="card-body">
                <div class="row">

                  <div class="col">
                    <div class="col">
                      <div class="form-group">
                        <label>Jumlah Hadir</label>
                        <?php
                        if ($fakul == 'C') {
                        ?>
                          <input style="width: 100%;" type="number" class="form-control" id="hadir" name="hadir" placeholder="Jumlah Hadir" value="" onkeypress="return hanyaAngka(event)" min="0" max="100" readonly />
                        <?php
                        } else {
                        ?>
                          <input style="width: 100%;" type="number" class="form-control" id="hadir" name="hadir" placeholder="Jumlah Hadir" value="" onkeypress="return hanyaAngka(event)" min="0" max="100" />
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <?php
                    if ($fakul == 'C') {
                    ?>
                      <div class="col">
                        <div class="form-group">
                          <label style="display: none;">Nilai Praktek</label>
                          <input style="width: 100%;" type="hidden" class="form-control" id="praktek" name="praktek" placeholder="Nilai Praktek" value="" onkeypress="return hanyaAngka(event)" min="0" max="100" readonly />
                        </div>
                      </div>
                    <?php
                    } else {
                    ?>
                      <div class="col">
                        <div class="form-group">
                          <label>Nilai Praktek</label>
                          <input style="width: 100%;" type="number" class="form-control" id="praktek" name="praktek" placeholder="Nilai Praktek" value="" onkeypress="return hanyaAngka(event)" min="0" max="100" />
                        </div>
                      </div>
                    <?php
                    }
                    ?>

                    <div class="col">
                      <div class="form-group">
                        <label>Nilai Tugas</label>
                        <input style="width: 100%;" type="number" class="form-control" id="tugas" name="tugas" placeholder="Nilai Tugas" value="" onkeypress="return hanyaAngka(event)" min="0" max="100" />
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label>Nilai MID</label>
                        <input style="width: 100%;" type="number" class="form-control" id="mid" name="mid" placeholder="Nilai MID" value="" onkeypress="return hanyaAngka(event)" min="0" max="100" />
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="col">
                      <div class="form-group">
                        <label>Nilai UAS</label>
                        <input style="width: 100%;" type="number" class="form-control" id="uas" name="uas" placeholder="Nilai UAS" value="" onkeypress="return hanyaAngka(event)" min="0" max="100" />
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Nilai</label>
                        <?php
                        if ($fakul == 'C') {
                        ?>
                          <input style="width: 100%;" type="text" class="form-control" id="jml_nilai" name="jml_nilai" placeholder="Nilai" readonly />
                        <?php
                        } else {
                        ?>
                          <input style="width: 100%;" type="text" class="form-control" id="jml_nilai" name="jml_nilai" placeholder="Nilai" />
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Grade Nilai</label>
                        <input style="width: 100%;" type="text" class="form-control" id="grade" name="grade" placeholder="Grade Nilai" readonly />
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </form>
          <!-- <p>One fine body&hellip;</p> -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">Close</button>
          <button type="button" class="btn btn-primary" id="save" name="save" style="float:right;">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

</div>