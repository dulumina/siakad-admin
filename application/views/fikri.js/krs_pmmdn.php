<?php if ($per = $this->session->userdata('periode')) {
  echo "<script> $('#SelectTahunPeriode').val($per) </script>";
}?>

<script>
let kelasKuliah;
let krs = $('#krs').DataTable();
let jadwal = $('#jadwal').DataTable();

$('#SelectTahunPeriode').on('change',()=>{
  window.location.href = "<?= base_url('ademik/Krs_pmmdn/Tahun_semester/') ?>"+$('#SelectTahunPeriode').val();
})

$('#pilihProdi').change(()=>{
  $('body').addClass("loading")
  jadwal.clear();
  jadwal.destroy();
  let prodi = $('#pilihProdi').val();
  let periode = $('#SelectTahunPeriode').val();
  if (prodi != '') {
    $('#cariMk').attr('disabled',false)
    
    $.post('<?= base_url(); ?>ademik/krs_pmmdn/getKelasKuliah',{prodi:prodi,periode:periode})
    .done(function(res){
      // console.log(res);
      kelasKuliah=JSON.parse(res);
      jadwal = $('#jadwal').DataTable({
        data: JSON.parse(res),
        columns: [
          // { data: 'SKS' },
          { data: 'NamaMK' },
          { data: 'waktu' },
          { data: 'KodeRuang' },
          { data: 'SKS' },
          { data: 'IDJADWAL' }
        ],
        columnDefs: [{
          targets:4,
          render: function (data, type, row, meta) {
            return '<button onclick=addMK("'+row.IDJADWAL+'") class="add btn btn-circle btn-sm"><i class="fa fa-plus"></i></button>';
            // return '<div class="form-group"> <div class="checkbox"> <input name="kelasKuliah" value="'+row.IDJADWAL+'" data-kmk="'+row.IDJADWAL+'" data-index="'+meta.row+'" class="ambil" type="checkbox" id="kmk_'+ meta.row +'"> <label for="kmk_'+ meta.row +'"></label> </div> </div>';
          },
        }],
      });
    })
    .always(function() {
      $('body').removeClass("loading")
    });
  }else{
    jadwal = $('#jadwal').DataTable()
    $('body').removeClass("loading")
  }
})

function addMK(idJadwal) {
  $('body').addClass("loading")
  $('button').prop('disabled', true);
  let nim = $('#nim').html();
  let periode = $('#SelectTahunPeriode').val();
  $.post("<?= base_url('ademik/krs_pmmdn/addMkKrs')?>",{IDJADWAL:idJadwal,nim:nim,periode:periode})
  .done((res)=>{
    let response = JSON.parse(res);
    if (response.status==0) {
      alert(response.msg)
    }
    $('#totalSKS').html(response.totalSKS.toFixed(1))
    renderKRS(response.krs);
    $('button').prop('disabled', false);
  })
  .always(function() {
    $('body').removeClass("loading")
  });
}

function getKrs(params) {
  // $('body').addClass("loading")
  $('button').prop('disabled', true);
  let nim = $('#nim').html();
  let periode = $('#SelectTahunPeriode').val();
  $.post("<?= base_url('ademik/krs_pmmdn/getKrs')?>",{nim:nim,periode:periode})
  .done((res)=>{
    let response = JSON.parse(res);
    // console.log(response);
    $('#totalSKS').html(response.totalSKS.toFixed(1))
    renderKRS(response.krs);
    $('button').prop('disabled', false);
  })
  .always(function() {
    $('body').removeClass("loading")
  });
}

function renderKRS(params) {
  krs.clear();
  krs.destroy();
  krs = $('#krs').DataTable({
    data:params,
    columns:[
      {data:'id'},
      {data:'NamaMK'},
      {data:'SKS'},
      {data:'prodi'},
      {data:'KodeRuang'},
      {data:'waktu'},
      {data:'id'},
    ],
    columnDefs: [{
      targets:6,
      render: function (data, type, row, meta) {
        return '<button onclick=removeMK("'+row.id+'") class="add btn btn-circle btn-sm"><i class="fa fa-trash"></i></button>';
      },
    }],
  })
  krs.on( 'order.dt search.dt', function () {
  krs.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
      cell.innerHTML = i+1;
    } );
  } ).draw();
}

function removeMK(params) {
  $('body').addClass("loading")
  $('button').prop('disabled', true);
  let nim = $('#nim').html();
  let periode = $('#SelectTahunPeriode').val();
  $.post("<?= base_url('ademik/krs_pmmdn/removeMK')?>",{id_krs:params})
  .done((res)=>{
    let response = JSON.parse(res);
    // console.log(response);
    $('#totalSKS').html(response.totalSKS.toFixed(1))
    renderKRS(response.krs);
    $('button').prop('disabled', false);
  })
  .always(function() {
    $('body').removeClass("loading")
  });
}

getKrs()
$(document).ready(function() {
    $('select').select2();
});
</script>
