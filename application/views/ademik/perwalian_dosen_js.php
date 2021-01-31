<script>
  $('#table_mahasiswa_wali').DataTable();
  let selectTahun = $('#tahunPeriode');
  $('#mhswMk').on('show.bs.modal', function (event) {
    // $("#mhswMk").Loadingdotdotdot({
    //     "speed": 400,
    //     "maxDots": 10,
    //     "word": "Loading"
    // });

    var button = $(event.relatedTarget) // Button that triggered the modal
    var nim = button.data('nim') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Krs Mahasiswa ' + nim)
    console.log(nim);
    let krs = GetKrs(nim,modal);

  })
  $('#mhswMk').on('hide.bs.modal', function () {
    $('#tbmk').html('');
  })
  function GetKrs(nim,modal) {
    $.get(window.location.href+'/listMk/'+nim,function(data) {
      // $("#mhswMk").Loadingdotdotdot("Stop");
      let krs = JSON.parse(data);
      $('#tbmk').html(tableMk(krs))
    })
  }
  function tableMk(krs) {
    let tombol = '';
    // console.log(krs);
    let row = '';
    for (let i = 0; i < krs.length; i++) {
      const mk = krs[i];
      
      tombol = status(mk)
      row = row+'<tr><td>'+mk.KodeMK+'</td><td>'+mk.NamaMK+'</td><td>'+mk.SKS+'</td><td id="st'+mk.id+'">'+tombol+'</td></rt>'
    }
    return row;
  }
  function change(params) {
    // console.log(params);
    const data = {
      'id' : params.getAttribute("key").replace('st',''),
      'st_wali' : params.getAttribute("st")
    };

    switch (data.st_wali) {
      case '1':
        data.st_wali = '0'
        $('#'+params.getAttribute("key")).html(status(data))
        set(data)
        break;
    
      case '0':
        data.st_wali = '1'
        $('#'+params.getAttribute("key")).html(status(data))
        set(data)
        break;
    }
    // $('#st'+mk.id).html(data)
  };
  function status(params) {
    let tombol = '';
    if (params.st_wali=='1') {
      tombol = '<i class="fa fa-check text-green pointer" onclick="change(this)" key="st'+params.id+'" st="1" aria-hidden="true"></i>'
    }else{
      tombol = '<i class="fa fa-exclamation text-red pointer" onclick="change(this)" key="st'+params.id+'" st="0" aria-hidden="true"></i>'
    }
    return tombol
  }
  selectTahun.on('change', function() {
    let url = window.location.href+'/setPeriode'
    // alert( this.value );
    
    $.post(url,{'periode':this.value})
    .done(function(){
      location.reload();
    })
  });

  function set(params) {
    let url = window.location.href+'/setSetujui'
    
    $.post(url,params)
    // .done(function(){

    // })
    // .fail(function(){

    // })
    // .always(function(){

    // })
  }
</script>
