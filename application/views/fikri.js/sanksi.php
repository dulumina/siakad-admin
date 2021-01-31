
    <!-- <script src="<?=base_url('assets/') ?>plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script> -->
<script>
  var input,table,thead,tfoot,tbody,tdata,base_url,stambuk,data;
  var listBlok = [];
  var nimc =[];
  var post_data =[];

    base_url = "<?= base_url('ademik/Sanksi/') ?>",
    thead = '<thead><tr><th>Nim</th><th>Nama</th><th>Prodi</th><th>Angkaan</th><th>Kasus</th><th>Tanggal Sanksi</th><th>aksi</th></tr></thead>';
    tfoot = '<tfoot><tr><th>Nim</th><th>Nama</th><th>Prodi</th><th>Angkaan</th><th>Kasus</th><th>Tanggal Sanksi</th><th>aksi</th></tr></tfoot>';
  function tr(td) {
    var tr = '';
    for (var i = 0; i < td.length; i++) {
      tr +=' <tr>';
      tr +='  <td>'+td[i].NIM+'</td>';
      tr +='  <td>'+td[i].Name+'</td>';
      tr +='  <td>'+td[i].KodeJurusan+'</td>';
      tr +='  <td>'+td[i].TahunAkademik+'</td>';
      tr +='  <td>'+td[i].kasus+'</td>';
      tr +='  <td>'+td[i].tgl_sanksi+'</td>';
      tr +='  <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-nim="'+td[i].NIM+'" data-Name="'+td[i].Name+'">Cabut</button></td>';
      tr +=' </tr>';      
    }
    return tr;
  }
  tabel()
  function tabel() {
  	$('#list').html('<div id="loader"></div>');
      $.post(
      base_url+'daftar',
      input,
      function(x_res){
      var res = JSON.parse(x_res);
      // console.log(res);
      if (res.status) {
        tdata = tr(res.data);
        tbody = '<tbody>'+tdata+'</tbody>';
        table = '<table id="example1" class="table table-bordered table-striped table-responsive">'+thead+tfoot+tbody+'</table>';
        $('#list').html(table);
        $('#example1').DataTable();
        $('#example1_filter').append('<button  onclick="tabel()" type="button" class="btn btn-default btn-xs">refresh</button>');
      }else{
        $('#list').html('<h4>'+res.ket+'</h4>');
      }
    });
  }
  $('#modal-danger').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var nim = button.data('nim') 
    var Name = button.data('name') 

    var modal = $(this)
    stambuk=nim;
    modal.find('.modal-title').text(Name+' - '+ nim)
    let mhs={'NIM':nim};
    nimc.push(mhs);
    modal.find('#msg').text('Cabut sanksi untuk '+Name+' - '+ nim+'...!')

  })
  function cabutSanksi() {
    input = {'NIM': stambuk};
    console.log(input);
    $.post(
      base_url+'cabut',
      input,
      function(x_res){
      var res = JSON.parse(x_res);
      // console.log(res);
      if (res.status) {
        console.log(res);
        tabel();
      }else{
        console.log(res);
      }
      $("#modal-danger").modal("hide")
    });
  } 
  function addListBlok() {

    var mhs = $('#mhsw').val();
    $(listBlok).filter(function(i,n){
      if (n.NIM==mhs) {
        console.log('nim sudah ada');
        // return;
      }else{

      }
    })
    
    $('#loading').show()
    $("#mhsw").prop('disabled', true);
    $("#add").prop('disabled', true);
    // var mhsw = mhs.split(',');
    $.post(
      base_url+'getMhsw',
      {'mhsw':mhs},
      function(xxx){
      var res = JSON.parse(xxx);
      // console.log(res);
      for (var i = 0; i < res.data.length; i++) {
        listBlok.push(res.data[i]);
      }
      
      lisBlok(listBlok);

    })
    .always(function(){
      $('#loading').hide()
      $("#mhsw").prop('disabled', false);
      $("#add").prop('disabled', false);
    });
  }

  function rmListBlok(inx) {
    listBlok.splice(inx,1);
    lisBlok(listBlok);
  }

  function lisBlok(mhsw) {
    console.log(mhsw);
    $('#listBlok li').remove();
    for (var i = 0; i < mhsw.length; i++) {
      $("#mhsw").val("");
      $('#listBlok').append('<li>'+mhsw[i].NIM+' '+mhsw[i].Name+'<span  onClick="rmListBlok('+i+')"  class="close">&times;</span></li>');
      // console.log
    }
  }

  // function proc(act) {
  //   $('#loading').show();
    
  //   post_data = {
  //     "status"	          : act,
  //     "NIM"	              : listBlok,
  //     "penanggung_jawab"	: $('#penanggungJawab').val(),
  //     "kasus"	            : $('#kasus').val(),
  //     "nomor_surat"	      : $('#skSanksi').val(),
  //     "keterangan"	      : $('#ket').val()
  //   };
        
  //   $.post(base_url+"proses",post_data)
  //   .done(function(res){
  //     console.log(res);
  //     alert('sukses...!');
  //   })
  //   .always(function(){
  //       $('#modal-danger').modal('hide');
  //       $('#loading').hide()
  //       nimc=[];
  //       listBlok=[];
  //   });
    
  // }


  function proc(act) {
    $('#loading').show();
    if (act=='1') {
      post_data = {
        "status"	          : act,
        "NIM"	              : listBlok,
        "penanggung_jawab"	: $('#penanggungJawab').val(),
        "kasus"	            : $('#kasus').val(),
        "nomor_surat"	      : $('#skSanksi').val(),
        "keterangan"	      : $('#ket').val()
      };
    }
    else if (act=='0') {
      post_data = {
        "status"	          : act,
        "NIM"	              : nimc,
        "penanggung_jawab"	: $('#penanggungJawabc').val(),
        "kasus"	            : $('#kasusc').val(),
        "nomor_surat"	      : $('#skSanksic').val(),
        "keterangan"	      : $('#ketc').val()
      };
    } else {
      $('#modal-danger').modal('hide');
      $('#loading').hide()
      alert('terjadi kesalahan');
      return;
    }
        
        
    console.log(post_data);
    $.post(base_url+"proses",post_data)
    .done(function(res){
      console.log(res);
      alert('sukses...!');
    })
    .always(function(){
        $('#modal-danger').modal('hide');
        $('#loading').hide()
        nimc=[];
        // listBlok=[];
    });
    
  }

</script>
