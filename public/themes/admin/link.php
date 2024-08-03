
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
	
	<div class="card-body">
		<hr/>
		<div class="row ">
        <table id="data_table" class="display dataTable  no-footer dtr-inline" role="grid">
                <thead>
                <tr role="row"><th> No. </th> <th>Logo </th><th> Link </th><th>Aksi </th> </tr>
                </thead>
			<?php
            $n=0;
			foreach($lists AS $val ) :
             $n++;   
			$image = (
						isset($val['image_url']) &&
						file_exists(Dee::$app->basePathe.'/uploads/dokumen/' . $val['image_url']) &&
						is_file(Dee::$app->basePathe.'/uploads/dokumen/'  . $val['image_url'])
					)
					? Dee::$app->baseUrl.'/public/uploads/dokumen/' . $val['image_url']
					: Dee::$app->baseUrl .'/public/assets/images/no-image/poster.jpg';
			?>
            
            <tr>
            <td><?= $n; ?> </td> 
            <td><img src="<?php echo $image;?>" class="img-fluid" style="width: 150px;"/></td>
            <td><?php echo $val['title_img'];?> </td>
           
            <td><div class="btn-group btn-group-sm  w-100">
                    <a href="<?= Dee::$app->baseUrl ?>/public/uploads/dokumen/<?php echo $val['image_url'];?>" class="btn btn-primary " style="border-radius: 0; font-size: 12px;"  > <i class="fas fa-download"></i></a>
					            <button class="btn btn-info " style="border-radius: 0; font-size: 12px;" data-id="" onclick="edit('<?php echo $val['id'];?>')"> <i class="fas fa-edit"></i></button>
					               <button class="btn btn-danger" style="border-radius: 0; font-size: 12px;" type="button"onclick="remove('<?php echo $val['id'];?>','<?= $delete_url ?>')"><i class="fas fa-trash"></i></button>
						</div> </td> </tr>
            
			
			<?php  endforeach;?>
            </table>
		</div>
	</div>

	<div class="card-footer" style="text-align:right;">
		<?php echo $pagination;?>
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
					<label>Link Url</label>
					<div class="input-group">
                       	<input type="hidden"  name="edit[id]"  />
                        <input type="hidden"  name="edit[id_album]"  />
                        <input type="hidden"  name="edit[kategori]" value="4" />
                        <input type="hidden"  id="image" name="edit[image_url]"  />
                        <input type="hidden"  name="edit[description]"  />
				   	<input type="text" class="form-control form-control-sm" name="edit[title_img]" placeholder="Nama" required />
                		</div>
			    	</div>
		      	
                <div class="form-group" style="background: #A9E6DE;padding: 10px;">
			<label>Status</label>
					<div style="height:30px; padding-top:4px;">
						<label class="radio-inline">
							<input type="radio" name="edit[status]" value="0" /> Tampil
                            &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; <input type="radio" name="edit[status]" value="1" /> Hidden
						</label>
					</div>
      			
			      </div>
   
                <div class="form-group">
					<label >Logo  </label>
                    <img class="rounded" style="width:200px;">
				    
					</div>
                    <div class="form-group">
					<label >Ganti Logo</label>
       		            <input type="file"  name="file" class="form-file " />
                       
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
                $('#modalEdit').find('.modal-body').find('input[name="edit[image_url]"]').val(data.image_url);
                $('#modalEdit').find('.modal-body').find('input[name="edit[title_img]"]').val(data.title_img);
                $('#modalEdit').find('.modal-body').find('textarea[name="edit[description]"]').val(data.description);
    
                $('#modalEdit').find('.modal-body').find('img').attr('src','<?= Dee::$app->baseUrl ?>/public/uploads/dokumen/'+data.image_url);
		        $('#modalEdit').find('.modal-body').find('input[value="'+data.status+'"]').attr('checked','');
            }
		});
	}
    function baru(id){
                $('#modalEdit').modal('show');
                $('#modalEdit').find('.modal-body').find('input[name="edit[id]"]').val('');
                $('#modalEdit').find('.modal-body').find('input[name="edit[kategori]"]').val(id);
                
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
