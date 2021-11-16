 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tables <?="fandu ".$this->session->userdata('int')." fandu ".$this->session->userdata('uname');?>
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         <div class="box">			
			<button type="button" id="addModul" class="btn btn-info" data-level="-" data-toggle="modal" data-target="#modal-info">
                + Group Modul
            </button>
		 </div>
		 
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Group Modul</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
					<tr>
						<th>ID</th>
						<th>Group Modul</th>
						<th>Level</th>
						<th>Not Active</th>
						<th>Not Active</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Group Modul</th>
						<th>Level</th>
						<th>Not Active</th>
						<th>Not Active</th>
					</tr>
				</tfoot>
				<tbody>
				<?php
				foreach ($tab as $a){ ?>
					<tr>
						<td id="tes"><?=$a->GroupModulID?></td>
						<td>
							<a class="lihatGroup" data-toggle="modal" data-target="#modal-info" id="group_<?=$a->GroupModulID?>" href="#<?=$a->GroupModul?>" 
								data-notactive="<?=$a->NotActive?>"
								data-id="<?=$a->GroupModulID?>" 
								data-name="<?=$a->GroupModul?>" 
								data-level="<?=$a->Level?>" 
							><?=$a->GroupModul?></a>
						</td>
						<td><?=$a->Level?></td>
						<td><?=$a->NotActive?></td>
						<td>
							<button type="button" class="btn btn-default" onClick="lihat(<?=$a->GroupModulID?>)" data-toggle="modal" data-target="#modal-default">Lihat Group Modul</button>
						</td>
					</tr>
				<?php }	?>
				</tbody>
			</table>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <!--<form action="<?=base_url()?>ademik/module/module/tes" method="POST">
	<input type="text" name="test">
	<input type="submit" value="simpan">
  </form>-->
  
  
			  <div class="modal fade" id="modal-default">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">Lihat Mudul</h4>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">Tambah Modul</button>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span></button>
					  </div>
					  <div class="modal-body">
						<!--<p>One fine body&hellip;</p>-->
						<div class="box-header">
							<h3 class="box-title">Group Modul</h3>
						</div>
          
              <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
									<tr>
										<th>Modul</th>
										<th>Link</th>
										<th>Level</th>
										<th>Status</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Modul</th>
										<th>Link</th>
										<th>Level</th>
										<th>Status</th>
									</tr>
								</tfoot>
								<tbody id="isitab">
								</tbody>
							</table>
					</div>
						
						
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					</div>
					<!-- /.modal-content -->
				  </div>
				  <!-- /.modal-dialog -->
			  </div>
			  <!-- /.modal -->
			  
			  
			  <div class="modal modal-info fade" id="modal-info">
					<form action="<?=base_url()?>ademik/module/module/addgroup" method="POST">
						<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">

							<h4 class="modal-title">List Group Modal</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								
							<input class="form-control" id="identifier" name="identifier" type="hidden">
							<div class="form-group">
								<input class="form-control" name="gropmod" placeholder="Group Model">
							</div>
							<div class="form-group">
								<label>Select Multiple</label>
								<select multiple class="form-control" id='ulevel' name="multi_array[]">
									<?php foreach($levels as $level) :?>
										<option value=<?= $level->Level; ?>><?= $level->Name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="demo-checkbox">
								<input type="checkbox" id="notActive" name="NotActive" checked />
								<label for="notActive">Avtive</label>
							</div>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
							<input type="submit" class="btn btn-outline" value="Save changes">
							</div>
						</div>
						<!-- /.modal-content -->
						</div>
				  </form>
				  <!-- /.modal-dialog -->
			  </div>
			  <!-- /.modal -->
			  
			  
			  <div class="modal modal-primary fade" id="modal-primary">
				  <div class="modal-dialog">
				  <form action="<?=base_url()?>ademik/module/module/addmodul" method="POST">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">Tambah Modul</h4><input id="groupmodulid" type="hidden" name="groupmodulid" readonly="readonly"/>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span></button>
					  </div>
					  <div class="modal-body">
						<!--<p>One fine body&hellip;</p>-->
						<div class="form-group">
							<input class="form-control" name="modul" placeholder="Nama Grodul">
						</div>
						<div class="form-group">
							<input class="form-control" name="modullink" placeholder="Link">
						</div>
						<div class="form-group">
							<label>Default Level</label>
							<select multiple class="form-control" name="modullev[]">
								<option value=1>Level 1</option>
								<option value=2>Level 2</option>
								<option value=3>Level 3</option>
								<option value=4>Level 4</option>
								<option value=5>Level 5</option>
							</select>
						</div>
						<div class="form-group">
							<input class="form-control" name="modulimg" placeholder="Image">
						</div>
						<div class="form-group">
							<input class="form-control" name="moduldesc" placeholder="Description">
						</div>
						<div class="form-group">
							<input class="form-control" name="modulaut" placeholder="Author">
						</div>
						<div class="demo-checkbox">
							<input type="checkbox" id="modulnot" class="filled-in chk-col-red" name="modulnot" checked />
							<label for="modulnot">NotActive</label>		
						</div>
						<div class="demo-checkbox">
							<input type="checkbox" id="modulajax" class="filled-in chk-col-red" name="modulajax" checked />
							<label for="modulajax">Use Ajax</label>		
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-outline float-right" name="addmodul_btn" value="Save changes"/>
					  </div>
					</div>
					</form>
					<!-- /.modal-content -->
				  </div>
				  <!-- /.modal-dialog -->
			  </div>
			  <!-- /.modal -->

<script>

wait$(()=>{
	$('#modal-info').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var id = button.data('id') 
		var name = button.data('name') 
		var actf = button.data('notactive')
		var level = button.data('level').split("-")
		if (actf=='Y') {
			document.getElementById('notActive').checked = false;
		}else{
			document.getElementById('notActive').checked = true;
		}
		$('#ulevel').val(level);
		$('#identifier').val(id);
		$('input[name=gropmod]').val(name);
	})

	$('#addModul').on('click',()=>{
		document.getElementById('notActive').checked = true;
		$('#ulevel').val('');
		$('#identifier').val('');
		$('input[name=gropmod]').val('');
	})
})

function lihat (id){
	//alert($('#tes').val()+" dan "+id);
	//alert('fandu');
	$.ajax({
		type: 'POST',
		data: 'id='+id,
		url: '<?=base_url()?>ademik/module/module/detail',
		success: function(response){
			$('#isitab').html(response);
			$('#groupmodulid').val(id);
		}
	});
	//alert('fandu');
}
</script>

