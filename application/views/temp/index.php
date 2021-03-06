<style type="text/css">

  img {
    width: 500px;
    height: 500px;
  }

  .judul {
    font-size: 16px;
    font-weight: 600;
  }

  .ket {
    color: #999;
    font-size: 13px;
  }

  .modal-fullscreen {
    padding: 0 !important;
  }
  .modal-fullscreen .modal-dialog {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    max-width: 100%;
  }
  .modal-fullscreen .modal-content {
    height: auto;
    min-height: 100%;
    border: 0 none;
    border-radius: 0;
  }

</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url()?>/menu"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- boxes (Stat box) -->
    <?php 
      $jumlahlogin  = $this->session->userdata('jumlahlogin'); 
      if ((!empty($this->session->flashdata('ubahpassword')) and $this->session->flashdata('ubahpassword') == "editpassword" ) or (!empty($jumlahlogin) and $jumlahlogin == "editpassword") ) { ?>
      <!-- <div class="modal fade bs-example-modal-lg infoNoHP" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true"> -->
      <div class="modal fade bs-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: block; padding-right: 17px;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myLargeModalLabel"><i class="fa fa-bullhorn"></i> Informasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <div class="callout callout-success">
                <h4>PENGUMUMAN</h4>
                <?php if($this->session->userdata('ulevel')=='4'){ ?>
                  <p>Anda Masih Menggunakan Password Default, Silahkan Ganti Password Anda </p>
                  <p>Diharapkan seluruh Mahasiswa Aktif di Universitas Tadulako untuk mengisi biodata lengkap di SIAKAD, Terutama Nomor HP yang digunakan saat ini </p>
                <?php }else{ ?>
                  <strong>Anda Masih Menggunakan Password Default, Silahkan Ganti Password Anda </strong>
                <?php } ?>
              </div>
            </div>
            <div class="modal-footer">  
              <a href=<?=base_url("ademik/Profil")?> class="btn btn-danger text-left"> Profile</a>
            </div>
          </div>
        </div>
      </div>

	  <div class="row">
        <div class="col">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <!-- <h2 class="text-center">
                    <strong>Anda Masih Menggunakan Password Default, Silahkan Ganti Password Anda <a href="https://siakad2.untad.ac.id/ademik/Profil" style="color: blue;">Klik Disini</a></strong>
                  </h2> -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	  <?php $data['status']=1;} ?>
      
      <div id="card"></div>
      <div id="tabelData" class="row">
        <!-- tabel inbound -->
        <div class="col-6 d-flex align-items-stretch">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Periode Pelaporan Lampau</h3>
              <h6 class="box-subtitle">Daftar Periode Pelaporan Lampau</h6>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="periodefdr" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive" cellspacing="0" width="100%">
              </table>
            </div>
          </div>
        </div>
        <!-- Tabel outbound -->
        <div class="col-6 d-flex align-items-stretch">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Title</h3>
              <h6 class="box-subtitle">Description</h6>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive" cellspacing="0" width="100%">
              </table>
              
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <!-- <div class="col-xl-6 connectedSortable"> -->
                <div class="col-md-7 col-lg-7">
                  <h2 class="text-center">
                    <strong>VISI & MISI UNIVERSITAS TADULAKO</strong>
                  </h2>
                  <h4 class="text-center">
                  	<strong>Visi</strong>
                  </h4>
                  <p style="padding: 0px 75px 0px 75px">“Universitas Tadulako Menjadi Perguruan Tinggi Berstandar Internasional Dalam Pengembangan IPTEKS Berwawasan Lingkungan Hidup”</p>
                  <!-- <p style="padding: 0px 75px 0px 75px; color: red;">PERSEPSI VISI UNTAD</p>
                  	<ol type= "1" style="margin: 0px 200px 0px 75px;">
                  		<li><b>Unggul</b> yang bermakna memberikan layanan yang terbaik kepada Stakeholder dan mereka memperoleh kepuasan.</li>
                  		<li><b>Pengabdian</b> yang mengandung roh atau hakikat bukan sebagai aktifitas melainkan sebagai layanan yang dipersembahkan dimana Tri Dharma Perguruan Tinggi sebagai dimensinya.</li>
                  		<li><b>Masyarakat</b> adalah siapapun yang menjadi Stakeholder Universitas Tadulako.</li>
                  	</ol>
                  <p style="padding: 25px 75px 0px 75px;"><b>Unggul Dalam Pengabdian</b> adalah kepuasan pelanggan atas layanan Tri Dharma Perguruan Tinggi yang diberikan kepada Stakeholder Universitas Tadulako.</p> -->
                  <h4 class="text-center">
                  	<strong>Misi</strong>
                  </h4>
                  <!-- <p style="padding: 0px 75px 0px 75px;">Misi Universitas Tadulako sebagai berikut :</p> -->
                  <ol>
                    <li>Menyelenggarakan pendidikan yang bermutu, modern, dan relevan menuju pencapaian standar internasional dalam pengembangan IPTEKS berwawasan lingkungan hidup.</li>
                    <li>Menyelenggarakan penelitian yang bermutu untuk pengembangan IPTEKS berwawasan lingkungan hidup.</li>
                    <li>Menyelenggarakan pengabdian kepada masyarakat sebagai pemanfaatan hasil pendidikan dan hasil penelitian yang di butuhkan dalam pembangunan masyarakat.</li>
                    <li>Menyelenggarakan akan reformasi birokrasi dan kerjasama regional, nasional dan internasional.</li>
                  </ol>
                </div>

                <?php
                  if ( ( $this->session->userdata('ulevel') == 1 OR  ( $this->session->userdata('ulevel') == 4 and $periode_spc->kode != $semester) ) and $ukt ) {
                ?>

                 <div class="col-md-5 col-lg-5">
                  <h2 class="text-center">
                    <strong>PENGUMUMAN STATUS PEMBAYARAN UANG SEMESTER</strong>
                  </h2>
                  <h4 class="text-center">
                    <strong>TAHUN AJARAN <?= strtoupper($periode_spc->periode); ?></strong>
                  </h4><br><br>
                  
                  <h4 class="text-left">
                    <?php 
                     if (!empty($ukt)) {
                       
                        foreach ($ukt as $ukt_tampil)  ?>

                          <table class="table table-bordered table-hover" style="font-size: 15px;">
                            <tr>
                              <td>Tahun Ajaran  </td>
                              <td><?php echo $ukt[0]['kode_periode']; ?></td>
                            </tr>
                            <tr>
                              <td>Stambuk  </td>
                              <td><?php echo $ukt[0]['nomor_induk']; ?></td>
                            </tr>
                            <tr>
                              <td>Waktu Berakhir pembayaran  </td>
                              <td><?php echo $ukt[0]['waktu_berakhir']; ?></td>
                            </tr>
                            <tr>
                              <td>Nominal Tagihan  </td>
                              <td><?php echo $ukt[0]['total_nilai_tagihan']; ?></td>
                            </tr>
                            <tr>
                              <td>Bank Pembayaran </td>
                              <td><?= ($ukt[0]['kode_bank']=='BMS')? 'Bank Mega Syariah': $ukt[0]['kode_bank']; ?></td>
                            </tr>
                            <?php if($ukt[0]['kode_bank']=='BMS') { ?>
                            <tr>
                              <td>Nomor VA (Virtual Account) </td>
                              <td><?= str_replace('F','82136',$ukt[0]['nomor_induk']) ?></td>
                            </tr>
                            <?php } ?>
                          </table> 

                        <?php 
                        
                      }else{
                        echo '<p style="font-size: 20px; color: red;" class="text-center">pembayaran spp '. strtoupper($periode_spc->periode) .' anda belum dibuka. mohon menunggu atau tanyakan difakultas masing - masing untuk info lebih lanjut </p>';
                    }   ?>
                    
                  </h4>

                </div>

                <?php } ?>
              <!-- /.row -->
              </div>
              <!-- ./box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </div>



      <!-- Main row -->
      <div class="row">
        <?php if($berita) : ?>
        <!-- Left col -->
        <section class="col-xl-6 connectedSortable">
          <!-- interactive chart -->
          <!-- TO DO List -->
          <div class="box">
            <div class="box-header">

              <?php
                $urutan = 1;
                $urutantgl = 1;
                foreach ($berita as $tampil) { ?>

                <div class="box-body">
                  <div>
                    <span class="judul"><?= $tampil->Judul; ?></span><br>
                    <span class="ket">Posting By <?= $tampil->Author; ?> | <?= $tgl[$urutantgl++] ?></span>
                  </div>
                  <div class="attachment-block clearfix">
                    <?php if ( empty($tampil->foto_berita) ) { ?>
                      <img class="attachment-img" src="<?=base_url();?>assets/images/Berita/notimages.jpg" alt="Attachment Image">
                    <?php } else  { ?>
                      <img class="attachment-img" src="<?=base_url();?>assets/images/Berita/<?= $tampil->foto_berita; ?>" alt="Attachment Image">
                    <?php } ?>

                    <div class="attachment-pushed">
                      <div class="attachment-text">
                        <?= $konten[$urutan++] ;?>...
                        <a title="Klik untuk Membaca Berita" href="<?=base_url();?>ademik/Berita/halaman_berita/<?= $tampil->ID ?>"><span style="color: red;">more</span></a>
                      </div>
                    </div>
                  </div>
                </div>

              <?php } ?>

            </div>
          </div>
        </section>
        <!-- /.Left col -->
        <?php endif; ?>
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-xl-6 connectedSortable">

            <div class="box box-info">
              <?php
                if ( $this->session->userdata('ulevel') == "" ) {
              ?>
              <div class="box-header">
              	<h5 class="text-center">
                      <strong>PENGUMUMAN</strong>
                </h5>
                <div class="attachment-block clearfix">
                    
                </div>
              </div>
              <?php
                } else if ( $this->session->userdata('ulevel') == 1 OR $this->session->userdata('ulevel') == 4 OR $this->session->userdata('ulevel') == 5 OR $this->session->userdata('ulevel') == 7) { ?>
              <div class="box-header">
              	<h4 class="text-center">
                  <strong>TUTORIAL PENGGUNAAN SIAKAD</strong>
                </h4>
                <h3 class="text-center">
                  <strong>Mahasiswa Harus Mandiri Ber KRS<br><i>say to no for GAPTEK</i></strong>
                </h3>
                <div class="attachment-block clearfix" align="center">
                  Cara Reset Password
                  <iframe width="690" height="388" src="https://www.youtube.com/embed/47z0v-J1uTM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="attachment-block clearfix" align="center">
                  <a title="See All Video" href="https://www.youtube.com/channel/UClHMdi-O34cHoG8sTK1tuZA/videos?view_as=subscriber"><span style="color: red;">See All Video from Youtube</span></a>
                </div>
                <!-- <div class="attachment-block clearfix" align="center">
                  KRS Mahasiswa - Error Import KHS ke DIKTI
                  <iframe width="690" height="388" src="https://www.youtube.com/embed/PcZTBKYxuc8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="attachment-block clearfix" align="center">
                  Untuk Mahasiswa Baru
                  <iframe width="690" height="388" src="https://www.youtube.com/embed/VhHP0rcwc7k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="attachment-block clearfix" align="center">
                  KRS Mahasiswa - Message Error Pada Saat Ber KRS
                  <iframe width="690" height="388" src="https://www.youtube.com/embed/6mw3Pn1KOX8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div> -->
              </div>
              <?php 
                } 
              ?>
              <!-- right col -->
            </div>

          </section>
        <!-- /.content -->
      </div>
<?php
$ulvl = $this->session->userdata('ulevel');
if ($ulvl != '4' && $ulvl != '10' && $ulvl ) { ?>
  <script>
    const card = document.getElementById("card");
    window.addEventListener('load', async function () {
      await fetch("<?=base_url("Dashboard/card/20211");?>")
              .then(data => data.text() )
              .then(data => {card.innerHTML = data} );

      await fetch("<?=base_url("Dashboard/periodeFeeder");?>")
              .then(data => data.json() )
              .then(data =>{
                $('#periodefdr').DataTable({
                  data: data,
                  columns: [
                    { title: "Prodi", data: (d)=>{
                      // return d.kode_prodi+" - "+d.nama_program_studi
                      return d.program_studi
                    }},
                    { title: "Semester", data: "semester"},
                    { title: "Batas waktu", data: (d)=>{
                      return d.tanggal_mulai_periode + " s/d " + d.tanggal_selesai_periode
                    }},
                    { title: "Tipe periode", data: "tipe_periode"},
                  ]
                });
              });
    })
    
  </script>
<?php } ?>
