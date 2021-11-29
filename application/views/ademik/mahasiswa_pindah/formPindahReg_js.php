<script>
  let token = "<?= $this->csrf->ajax_token('token') ?>";
  let base_url = "<?= base_url() ?>";
  $('#cariNim').click(function() {
    let nim = $('.nim').val()
    let url = base_url+'ademik/mhswpindah/cariMahasiswa'
    let data = {"nim":nim,"<?= $this->csrf->ajax_token('name') ?>": token}
    $.post(url , data)
    .done(function(response) {
      $('#program').show();
      console.log(response);
      alert( "success" );
    })
    .fail(function(error) {
      console.log(error);
      alert( "error" );
    })
    .always(function() {
      // alert( "finished" );
    });
  });

  $('#program').change(function() { 
    let prog = $( "#program option:selected" ).val()
    let nim = $('.nim').val();
    let url = base_url+'ademik/mhswpindah/prosesPindahReg';

    alert( "cari mahasiswa... " + prog );
  });

</script>

<!-- fitri________________________________________ -->

<!-- <script type="text/javascript">

  function mencari() {

var nim = $('#nim').val();

if ( nim == '' ) {

  swal({   
    title: 'Peringatan',   
    type: 'warning',
    text: 'Silakan Masukan Stambuk',
    confirmButtonColor: '#f7cb3b',   
  });

} else {

  $body = $("body");
  $body.addClass("loading");

  $.ajax({
      url: "<?= base_url('ademik/mhswpindah/dataMhswPindaReg'); ?>/"+nim,
      type: 'POST',
      dataType: 'json',
      cache : false,
      success: function(data){
          $body.removeClass("loading");

      if ( data == null ) {

        swal({   
          title: 'Peringatan',   
          type: 'warning',
          text: 'Stambuk yang Anda Masukan Tidak Sesuai',
          confirmButtonColor: '#f7cb3b',   
        });

      } else {

        $('#nama').val(data.Name);
        $('#fakultas').val(data.Singkatan);
        $('#jurusan').val(data.Nama_Indonesia);
        $('#alamatS').val(data.Alamat);

      }

      },
      error: function (err) {
          console.log(err);
      }
  });

}

}

function alert_peringatan(msg) {
return swal({   
  title: 'Peringatan',   
  type: 'warning',
  html: msg,
  confirmButtonColor: '#f7cb3b', 
})
}	

function alert_error(text) {
if (text!=null) {
  return Swal({
    type					: 'error',
    title					: text,
    showConfirmButton		: false,
    timer					: 1000
  })
}
else{
  return Swal({
    type					: 'error',
    title					: 'Data gagal disimpan',
    showConfirmButton		: false,
    timer					: 1000
  })
}

}

</script> -->