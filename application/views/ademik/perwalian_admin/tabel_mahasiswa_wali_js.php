<script src="<?=base_url()?>assets/plugins/jquery_validation/jquery.form.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery_validation/jquery.validate.js"></script>
<script src="<?=base_url()?>assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?=base_url()?>assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/sweetalert2/dist/sweetalert2.min.css">
<script src="<?=base_url()?>assets/js/pages/data-table.js"></script>

<script>
    function loading_alert() {
      swal({
        title		: 'Mohon Tunggu Sebentar',
        html  	: 'Sedang Mengambil Data',
        onOpen	: () => {
          swal.showLoading()
        }
      })
    }

    function swal_close() {
		  swal.closeModal();
	  }	

    function success_alert() {
      swal({
        type	: 'success',
        title	: 'Data Tersimpan',
        showConfirmButton: false,
        timer	: 1000,
      })
    }

    function error_alert(text="Data gagal disimpan", subtext="") {
      swal({
        type: 'error',
        title: text,
        text: subtext
      })
    }

    function notfound_alert() {
      swal({
        type: 'error',
        title: 'Data tidak ditemukan',
        text: '-'
      })
    }

    var table = $('#table_mahasiswa_wali').DataTable();
    
    $('#table_mahasiswa_wali tbody').on('click', 'button', function () {
        
        loading_alert();
        
        var data = table.row($(this).parents('tr')).data();

        $('.form_mahasiswa_wali').modal({
            'backdrop': 'static'
        });

        $.post(
            "<?= base_url('ademik/Perwalian_admin/form_mahasiswa_wali')?>", {
              NIM   : data[1],
              Tahun : "<?= $mahasiswa_wali[0]['Tahun'] ?>",
              Name  : data[3]
            }
          )
          .done(function (response) {
            $('#modal_mahasiswa_wali').html(response);
            swal_close();
          })
          .fail(function (response) {
            notfound_alert();
            $('#modal_mahasiswa_wali').html('');
          });
    });

</script>
<!-- 

<script type="text/javascript">

  var table = $('#table_mahasiswa_wali').DataTable();



  function load_tabel_mahasiswa_wali() {
    success_alert();

    $.post(
        "<?= base_url('ademik/Perwalian_admin/mahasiswa_wali')?>", {
          semester: "<?= $semester ?>",
          program: "<?= $program ?>",
          jurusan: "<?= $jurusan ?>"
        }
      )
      .done(function (response) {
        $('#load_content').html(response);
      })
      .fail(function (response) {
        notfound_alert();
        $('#load_content').html('');
      });
  }

  $('#table_mahasiswa_wali tbody').on('click', 'button', function () {
    loading_alert()

    var data = table.row($(this).parents('tr')).data();

    $('.form_mahasiswa_wali').modal({
      'backdrop': 'static'
    });


    $.post(
        "<?= base_url('ademik/Perwalian_admin/form_mahasiswa_wali')?>", {
          NIM: data[0],
          Tahun: "<?= $mahasiswa_wali[0]['Tahun'] ?>",
          Name: data[2]
        }
      )
      .done(function (response) {
        $('#modal_mahasiswa_wali').html(response);
        swal_close();
      })
      .fail(function (response) {
        notfound_alert();
        $('#modal_mahasiswa_wali').html('');
      });

  });
</script>

<script type="text/javascript">
	jQuery.extend(jQuery.validator.messages, {
		required: "<b style ='color:salmon'>Mohon isi dulu kolom yang disediakan <b>"
	});

	$("#form_validation").validate({
		submitHandler: function(form){
			var semester = $('#input_semester').val();
			var program  = $('#input_program').val();
			var	jurusan  = $('#input_jurusan').val();

			loading_alert();

			$.post(
					"<?= base_url('ademik/Perwalian_admin/mahasiswa_wali')?>", 
					{
						semester 	: semester,
						program 	: program,
						jurusan 	: jurusan
					}
			)
			.done(function (response) {
				 $('#load_content').html(response);
			})
			.fail(function (response) {
				notfound_alert();
				 $('#load_content').html('');
			});
		}
	});


	}	    





</script> -->