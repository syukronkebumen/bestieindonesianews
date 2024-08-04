<div class="card">
	<div class="card-header">
		<div class="row">
            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
                <h3 class="card-title"><?php echo ucwords($title);?></h3>
            </div>
            <div class="col-md-6 col-12 d-flex d-md-block justify-content-center mb-md-0 mb-2">
                <div class="btn-group float-md-right" role="group">

                     <button type="button" class="btn btn-info btn-sm" onclick="baru('<?= $cat ?>')"><i class="fa fa-fw fa-upload"></i> Buat Baru </button>

                </div>
            </div>
        </div>
	</div>
	<form class="multicheckbox-form" style="padding:1.25rem; padding-bottom: 0; display:none;" action="<?php echo $delete_multiple_url;?>" class="ajax">
		<div class="form-group hidden">
			<select class="form-control multicheckbox-select" name="id[]" multiple="multiple"></select>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group">
					<label>Action</label>
					<div style="height:30px; padding-top:4px;">
						<label class="radio-inline">
							<input type="radio" name="pilih-act" value="delete" checked=""> Delete
						</label>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<strong class="multicheckbox-count">0</strong> items dipilih. Anda yakin Akan Menghapusnya?
				<button type="submit" class="btn btn-success btn-sm">Yes</button> or
				<button type="button" class="btn btn-danger btn-sm multicheckbox-clear">Cancel</button>
			</div>
		</div>
	</form>
	<div class="card-body">
		<div class="checkbox"><label class="mb-0"><input type="checkbox" id="checkall"/> Check all image in this page</label></div>
		<hr/>
		<div class="row ">
			<?php
			foreach($lists AS $val ) :
				$image = (
						isset($val['image_url']) &&
						file_exists(Dee::$app->basePathe.'/uploads/slide/thumb/' . $val['image_url']) &&
						is_file(Dee::$app->basePathe.'/uploads/slide/thumb/'  . $val['image_url'])
					)
					? Dee::$app->baseUrl.'/public/uploads/slide/thumb/' . $val['image_url']
					: Dee::$app->baseUrl .'/public/assets/images/no-image/poster.jpg';
                    $f = $val['status'] == 0 ? '' : 'filter: grayscale(1);';
			?>
			<div class="col-md-3 mb-3">
				<div class="galeri-album-item">
				<div class="image">
						<img src="<?php echo $image;?>" class="img-fluid" style="width: 100%;<?= $f ?>"/>
						<div class="btn-group btn-group-sm  w-100">

					            	<button class="btn btn-warning " style="border-radius: 0; font-size: 12px;" type="button">
                                    <input type="checkbox" value="<?php echo $val['id'];?>" id="<?php echo $val['image_url'];?>" class="multicheckbox-item"/></button>
                                    <button class="btn btn-info " style="border-radius: 0; font-size: 12px;" data-id="" onclick="edit('<?php echo $val['id'];?>')"><i class="fa fa-edit"></i> Edit</button>
					               <button class="btn btn-danger" style="border-radius: 0; font-size: 12px;" type="button"onclick="remove('<?php echo $val['id'];?>','<?= $delete_url ?>')"><i class="fa fa-ban"></i> Delete</button>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</div>

	<div class="card-footer" style="text-align:center;">
		<?php echo $pagination;?>
	</div>
</div>
<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Upload Image</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div id="upload" class="dropzone dz-clickable" style="background:#F8F9FA; margin:-15px;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<form action="<?php echo $simpan_url ?>" autocomplete="off" method="POST" class="ajax" style="border: 1px solid rgba(0,0,0,.125); font-size:12px; border-radius: 5px; overflow: hidden; padding: 20px;">
		<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Edit Image</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama</label>
					<div class="input-group">
                       	<input type="hidden"  name="edit[id]"  />
                        <input type="hidden"  name="edit[kategori]"  />
                        <input type="hidden" name="edit[id_album]"  />
						<input type="text" class="form-control form-control-sm" name="edit[title_img]" placeholder="Judul gambar" required />

						</div>
			    	</div>
				<div class="form-group iklan">
					<label>Status</label>
					<div style="height:30px; padding-top:4px;">
						<label class="radio-inline">
							<input type="radio" name="edit[status]" value="0" /> Aktif
                            &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; <input type="radio" name="edit[status]" value="1" /> Tidak Aktif
						</label>
                     <textarea class="form-control form-control-sm" name="edit[description]" placeholder="Keterangan" /></textarea>
			
					</div>
				</div>
	          	<div class="form-group galery">
					<label>Keterangan</label>
					<div class="input-group">
                        <input type="text" name="edit[status]" value="0" />
						<textarea class="form-control form-control-sm" name="edit[description]" placeholder="Keterangan" /></textarea>
					</div>
				</div>
                <div class="form-group">
					<label >Photo</label>
				            <input type="file" id="inputFile" name="file" class="form-image custom-file-input" />
                          	<img class="rounded mx-auto img-fluid d-block mb-1" style="width: 100%;" src="" />
						    <div class="input-group"> <label class="custom-file-label" for="inputFile"></label>	</div>
                            <br /><br />
			                 <p class="help-block gal"><i class="fa fa-info-circle text-primary"></i> Recomended dimention 750x540 pixel and max 2.0MB</p>
							<p class="help-block ikl"><i class="fa fa-info-circle text-primary"></i> Recomended dimention 750x150 pixel and max 2.0MB</p>
             			</div>



			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>

			</div>
            </form>
		</div>
	</div>
</div>

<script type="text/javascript">
Dropzone.autoDiscover = false;
$(document).ready(function(){
    $('#checkall').multipleCheckboxGaleri();

	$("#upload").dropzone({
		url: "<?php echo $upload_url;?>",
		maxFilesize: 5,
		dictDefaultMessage:"<i class='fa fa-upload '></i><p>Upload here <small>(click or drop files)</small></p>",
		success: function(file, response){
			Swal.fire({
									position: 'center',
									icon: 'success',
									title: response.message,
									showConfirmButton: false,
									timer: 1500
								})
		},
		error : function(file, response){
			Swal.fire({
										position: 'center',
										icon: 'error',
										title: response.message,
										showConfirmButton: false,
										timer: 1500
									})
		},
		queuecomplete : function (file,response) {
			setTimeout(function(){
				location.reload();
			},1000);
		}
	});

	$("#select-album").select2({placeholder:"Please select one", allowClear:true});
	$('input[name="pilih-act"]').change(function(){
		var i = $(this).val();
		if (i == 'delete') {
			$('#col-select-album').addClass('d-none');
			$('.multicheckbox-form').attr('action','admin/slide/delete-multiple');
			$('#pilihan').text('menghapus');
		}else{
			$('#col-select-album').removeClass('d-none');
			$('.multicheckbox-form').attr('action','admin/slide/change-album');
			$('#pilihan').text('memindahkan');
		}
	});
});

    function edit(id){
        $.ajax({
			beforeSend:function() { $('.preloader-wrapper').show();	},
			type: "POST",
			url : '<?= $getOne ?>',
			data : {id:id},
			dataType:'JSON',
			success: function(data) {
			    $('.preloader-wrapper').hide();
				$('#modalEdit').modal('show');
		        $('#modalEdit').find('.modal-body').find('input[name="edit[id]"]').val(data.id);
                $('#modalEdit').find('.modal-body').find('input[name="edit[kategori]"]').val(data.kategori);
                $('#modalEdit').find('.modal-body').find('input[name="edit[id_album]"]').val(data.id_album);
                $('#modalEdit').find('.modal-body').find('input[name="edit[title_img]"]').val(data.title_img);
                $('#modalEdit').find('.modal-body').find('textarea[name="edit[description]"]').val(data.description);
                $('#modalEdit').find('.modal-body').find('input[value="'+data.status+'"]').attr('checked','');
                $('#modalEdit').find('.modal-body').find('img').attr('src', data.img);
                
			}
		});
	}
    function baru(id){
                $('#modalEdit').modal('show');
                $('#modalEdit').find('.modal-body').find('input[name="edit[id]"]').val('');
                $('#modalEdit').find('.modal-body').find('input[name="edit[kategori]"]').val(id);
                $('#modalEdit').find('.modal-body').find('input[name="edit[id_album]"]').val('foto');
                $('#modalEdit').find('.modal-body').find('input[name="edit[title_img]"]').val('');
                $('#modalEdit').find('.modal-body').find('textarea[name="edit[description]"]').val('');
                $('#modalEdit').find('.modal-body').find('img').attr('src', '<?= Dee::$app->baseUrl ?>/public/assets/images/no-image/poster.jpg');
        }
        <?php if (isset($cat) && $cat == '2'): ?>
		        	setTimeout(function(){
		        		$('.galery').addClass('d-none');
                        $('.help-block.gal').addClass('d-none');
		        	},1000)
		        <?php else: ?>
                    setTimeout(function(){
		        		$('.iklan').addClass('d-none');
                        $('.help-block.ikl').addClass('d-none');
		        	},1000)
                <?php endif; ?>
</script>
