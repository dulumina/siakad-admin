<script>

$body = $("body");
var t = $('#log').DataTable();
let num =1;
var counter = 1;
let st='';
let baseUrl = "<?= base_url('ademik/prc/sync_status_mhsw/') ?>";
let form={};
let list=[];
let dataBin = {
      'id_registrasi_mahasiswa' : '',
      'id_jenis_keluar' : '',
      'tanggal_keluar' : '',
      'id_periode_keluar' : '',
      'keterangan' : '',
      'nomor_sk_yudisium' : '',
      'tanggal_sk_yudisium' : '',
      'ipk' : '',
      'nomor_ijazah' : '',
      'jalur_skripsi' : '',
      'judul_skripsi' : '',
      'bulan_awal_bimbingan' : '',
      'bulan_akhir_bimbingan' : '',
    };

// console.log(baseUrl);
$('#exampleModal').on('show.bs.modal', function (event) {
  
  $body.addClass("loading");
  var button = $(event.relatedTarget) 
  st = button.data('whatever') 
  $.post(baseUrl+'getListMhsw',{ 'st': st })
  .done(function(response){
    list = res = JSON.parse(response);
    
    $body.removeClass("loading");
  });
})


$('#prc').click(function(){
  
  $body.addClass("loading");
  $('#prc').prop('disabled', true);
  form.jenisKeluar = $("#jk").val()
  form.tanggalKeluar = $("#tk").val()
  form.idPeriodeKeluar = $("#pk").val()
  form.keterangan = $("#ket").val()
  form.where = st
    // console.log(list);
  for (let i = 0; i < list.length; i++) {
    const mhsw = list[i];
    // $.post(baseUrl+'getHistoryPendidikan',{'nim': mhsw.nim})
    // .done(function(response){
    //   let res = JSON.parse(response)[0];
    //   console.log(res);
      dataBin = {
        'id_registrasi_mahasiswa' : mhsw.id_reg,
        'id_jenis_keluar' : $("#jk").val(),
        'tanggal_keluar' : $("#tk").val(),
        'id_periode_keluar' : $("#pk").val(),
        'keterangan' : $("#ket").val(),
        'nomor_sk_yudisium' : mhsw.NomorSKYudisium,
        'tanggal_sk_yudisium' : mhsw.TglSKYudisium,
        'ipk' : mhsw.ipk,
        'nomor_ijazah' : mhsw.NomerIjazah,
        'jalur_skripsi' : '',
        'judul_skripsi' : mhsw.JudulTA,
        'bulan_awal_bimbingan' : '',
        'bulan_akhir_bimbingan' : '',
        'nim' : mhsw.nim
      }
      
      prosesMhsw(dataBin);
    // })
    if (i == list.length) {
      $body.removeClass("loading");
    }
  }

});

function prosesMhsw(params) {
  
  $body.addClass("loading");
  $.post(baseUrl+'prosesMhsw',params)
    .done(function(response){
      res = JSON.parse(response);
      // console.log(res.fdr.data);
      t.row.add([num,params.nim,'sukses']).draw( false );
      num++;
      
    })
    .always(function(){
      $('#prc').prop('disabled', false);
      
      $body.removeClass("loading");
    });

}
</script>