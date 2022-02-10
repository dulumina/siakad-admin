<?php if ($per = $this->session->userdata('periode')) {
  echo "<script> $('#SelectTahunPeriode').val($per) </script>";
}?>
<script>

  function showProfiles(profile) {
    // console.log(profile);
    if (profile=='clear') {
      $('#nim').val('');
      $('#nama').val('');
      $('#univAsal').val('');
      $('#proAsal').val('');
      $('#totalSKS').val('');
    }else{
      $('#nim').val(profile.nim);
      $('#nama').val(profile.name);
      $('#univAsal').val(profile.univ_asal);
      $('#proAsal').val(profile.prodi_asal);
      $('#totalSKS').val(profile.totalSKS);
    }
  }
</script>
<?php if(in_array($this->session->userdata('ulevel'),[1,5,6,7])): ?>
  <script>
    let cariKrs={periode:'',nim:''};
    $('#SelectTahunPeriode').on('change',()=>{
      cariKrs.periode = $('#SelectTahunPeriode').val();
      listenKeyWord()
    })

    let timeoutID = null;
    function cariNims(str) {
      $('#loadSearch').css({display:''})
      $.post("<?= base_url('ademik/Krs_pmmdn/cari_nims') ?>",{keyWord:str})
      .done(function(res){
        let data = JSON.parse(res);
        if (data.length >= 1) {
          for (let i = 0; i < data.length; i++) {
            const row = data[i];
            $('#listNim').append("<option value='"+row.nim+"'>"+row.name+"</option>")
          }
        }else{
          $('#listNim').html("")
        }
        // console.log(data);
        // console.log(JSON.parse(data));
      })
      .always(function() {
        $('#loadSearch').css({display:'none'})
      })
    }
    $('#cariNim').keyup(function(e) {
      $('#listNim').html("")
      clearTimeout(timeoutID);
      const value = e.target.value
      timeoutID = setTimeout(() => cariNims(value), 1000)
    });

    $('#cariNim').change(function(){
      cariKrs.nim = $(this).val();
      listenKeyWord()
    })
    function listenKeyWord() {

      if (cariKrs.periode.length > 0 && cariKrs.nim > 0) {
        // console.log("oke cari...");
          // showProfiles('clear')

        $('body').addClass("loading")
        setTimeout(function(){
          // console.log(cariKrs);
          $.post("<?= base_url('ademik/Krs_pmmdn/getProfile')?>", cariKrs)
          .done(function(data){
            let profile = JSON.parse(data);
            // console.log(profile.token);

            showProfiles(profile);
            getKrs()
            if (profile.length > 0) {
              aletr('Mahasiswa tidak terdaftar.');
            }
          })
          .always(function() {
            $('body').removeClass("loading")
          })
        } , 2000)
      }
    }
  </script>
<?php else: ?>
  <script>
    let profile = JSON.parse('<?= json_encode($profile) ?>');
    showProfiles(profile);
    // console.log(profile); 
    $('#SelectTahunPeriode').on('change',()=>{
      getKrs()
      // window.location.href = "<?= base_url('ademik/Krs_pmmdn/Tahun_semester/') ?>"+$('#SelectTahunPeriode').val();
    })
  </script>
<?php endif; ?>
<script>

let kelasKuliah;
let krs = $('#krs').DataTable();
let jadwal = $('#jadwal').DataTable();


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
        columnDefs: [
          {
            targets:4,
            render: function (data, type, row, meta) {
              return '<button onclick=addMK("'+row.IDJADWAL+'") class="add btn btn-circle btn-sm"><i class="fa fa-plus"></i></button>';
              // return '<div class="form-group"> <div class="checkbox"> <input name="kelasKuliah" value="'+row.IDJADWAL+'" data-kmk="'+row.IDJADWAL+'" data-index="'+meta.row+'" class="ambil" type="checkbox" id="kmk_'+ meta.row +'"> <label for="kmk_'+ meta.row +'"></label> </div> </div>';
            },
          },{
            targets:0,
            render:function (data, type, row, meta) {

              let listDosen=row.dosen;
              let dosen='';
              for (let i = 0; i < listDosen.length; i++) {
                dosen += i+1 + '). ' + listDosen[i].nama_dosen+'<br>';
              }
              return '<b>' + data +'</b><br>'+dosen
            }
          }
        ]
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
  let nim = $('#nim').val();
  let periode = $('#SelectTahunPeriode').val();
  $.post("<?= base_url('ademik/krs_pmmdn/addMkKrs')?>",{IDJADWAL:idJadwal,nim:nim,periode:periode})
  .done((res)=>{
    let response = JSON.parse(res);
    if (response.status==0) {
      swal("Upps!", response.msg, 'error');
    }
    if (response.status==1) {
      swal("Berhasil!", response.msg, 'success');
    }
    // $('#totalSKS').val(response.totalSKS.toFixed(1))
    // renderKRS(response.krs);
    getKrs();
    $('button').prop('disabled', false);
  })
  .always(function() {
    $('body').removeClass("loading")
  });
}

function getKrs(params) {
  $('body').addClass("loading")
  $('button').prop('disabled', true);
  let nim = $('#nim').val();
  let periode = $('#SelectTahunPeriode').val();
  let dataPost = {nim:nim,periode:periode};
  // console.log(dataPost);
  $.post("<?= base_url('ademik/krs_pmmdn/getKrs')?>",dataPost)
  .done((res)=>{
    let response = JSON.parse(res);
      // console.log(response.krs.length);

    if (response.krs.length >= 1) {
      // console.log(response.krs);
      $('#totalSKS').val(response.totalSKS.toFixed(1))
      // console.log(response.krs);
      renderKRS(response.krs);

      $('#dwnldKrs').attr('href', "<?= base_url('ademik/Krs_pmmdn/cetakKrs/'); ?>" + response.token);
      $('button').prop('disabled', false);
      $('#dwnldKrs').css({display:''})
      $('#tblKrs').css({display:''})
    }
  })
  .always(function() {
    $('#boxTabelKrs').css({display:''})
    $('body').removeClass("loading")
  });
}

function renderKRS(params) {
  $('#boxTabelKrs').css({display:''})
  // console.log(params);
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
    },{
      targets: 1,
      render: function (data, type, row, meta) {
        // console.log(row);
        let listDosen=row.dosen;
        let dosen='';
        for (let i = 0; i < listDosen.length; i++) {
          dosen += i+1 + '). ' + listDosen[i].nama_dosen+'<br>';
        }
        return '<b>' + data +'</b><br>'+dosen

      }
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
  let nim = $('#nim').val();
  let periode = $('#SelectTahunPeriode').val();
  $.post("<?= base_url('ademik/krs_pmmdn/removeMK')?>",{id_krs:params,nim:nim})
  .done((res)=>{
    let response = JSON.parse(res);
    // console.log(response);
    // $('#totalSKS').val(response.totalSKS.toFixed(1))
    // renderKRS(response.krs);
    if (response.status==1) {
      swal("Berhasil!", response.msg,'success');
    }
    getKrs();
    $('button').prop('disabled', false);
  })
  .always(function() {
    $('body').removeClass("loading")
  });
}

// getKrs()
$(document).ready(function() {
    $('select').select2();
    $('#pilihProdi').select2({
      dropdownParent: $("#exampleModalPreview")
    });
});
</script>
