
<?php
  date_default_timezone_set("Asia/Makassar");
  $ttl = 0;
  if (isset( $_SESSION['timeToLeft'] )) {
    $ttl = $_SESSION['timeToLeft'];
  }
  $date = new DateTime(date('Y-m-d H:i:s'));
  date_add($date, date_interval_create_from_date_string("$ttl seconds"));
  $dateNow = date_format($date, 'Y-m-d H:i:s');
?> 
<script>
  function startTimer() {
    var countDownDate = new Date("<?= $dateNow; ?>").getTime();
    var x = setInterval(function() {
      var now = new Date().getTime();
      var distance = countDownDate - now;
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("timer").innerHTML =  minutes + "m " + seconds + "s ";
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("flashdata").innerHTML = "";
      }
    }, 1000);
  }
</script>

<?php $this->load->view('temp/head'); ?> 
  <!-- Content Wrapper. Contains page content -->
  <div id="template">
  <?php 
  $this->load->view('ademik/index'); ?>
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('temp/footers'); ?>
<!-- cek cek cek -->