<script>
$('#SelectTahunPeriode').change(()=>{
  let periode = $('#SelectTahunPeriode').val();
  if (periode != 'periode') {
    window.location.href="<?= base_url('ademik/Krs_pmmdn/Tahun_semester/')?>" + periode;  
  }
})
</script>