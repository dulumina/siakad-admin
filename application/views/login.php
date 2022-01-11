
<?php
  date_default_timezone_set("Asia/Makassar");
  $ttl = 0;
  if (isset( $_SESSION['timeToLeft'] )) {
    $ttl = $_SESSION['timeToLeft'];
  }
  $date = new DateTime(date('Y-m-d H:i:s'));
  date_add($date, date_interval_create_from_date_string("$ttl seconds"));
  $dateNow = date_format($date, 'Y-m-d H:i:s');
  if(isset($_COOKIE['ucokexp'])){ 
    $ucokexp = $_COOKIE['ucokexp'];
  }else{
    $ucokexp = 0;
  }
?> 
<script src="<?= base_url('assets/js/page.js'); ?>"></script>

<?php $this->load->view('temp/head'); ?> 
  <!-- Content Wrapper. Contains page content -->
  <div id="template">
  <?php 
  $this->load->view('ademik/index'); ?>
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('temp/footers'); ?>
<!-- cek cek cek -->
