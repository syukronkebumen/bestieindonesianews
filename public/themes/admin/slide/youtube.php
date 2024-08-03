
<style>
.nama{
   font-size: 9px;
   background-color: #DEC712;
    }
</style>   
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
			<?php
            function youtube($url)
          {
            $link = str_replace('https://www.youtube.com/watch?v=', '', $url);
            return $link;
          }
      
      		foreach($lists AS $val ) :
                if($val['id_album'] <> 1){
				$image = (isset($val['description']) )? 'https://img.youtube.com/vi/'.youtube($val['description']).'/hqdefault.jpg' : Dee::$app->baseUrl .'/public/assets/images/no-image/poster.jpg';
			?>
			<div class="col-md-3 mb-3">
				<div class="galeri-album-item">
				<div class="image">
						<img src="<?php echo $image;?>" class="img-fluid" style="width: 100%;"/>
			             <div class="btn-group btn-group-sm  w-100">
			                 <button class="btn btn-info " style="border-radius: 0; font-size: 12px;" data-id="" onclick="edit('<?php echo $val['id'];?>')"> Edit</button>
					               <button class="btn btn-danger" style="border-radius: 0; font-size: 12px;" type="button"onclick="remove('<?php echo $val['id'];?>','<?= $delete_url ?>')">Delete</button>
						</div>
					</div>
				</div>
			</div>
			<?php } endforeach;?>
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
				<h4 class="modal-title" id="myModalLabel">Edit Link Video Youtube</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Jenis Galery</label>
					<div class="input-group">
                       	<input type="hidden"  name="edit[id]"  />
                        <input type="hidden"  name="edit[image_url]"  />
                        <input type="hidden"  name="edit[id_album]" value="10" />
                        <input type="hidden"  name="edit[kategori]" value="10" />
                        <input type="hidden"  name="edit[title_img]" value="video"/>
                        <input type="text" class="form-control form-control-sm" value="video" disabled/>
    				    </div>
			    	</div>
				
	          	<div class="form-group galery">
					<label>Link Youtube</label>
					<div class="input-group">
						<textarea class="form-control form-control-sm" name="edit[description]" placeholder="link youtube" /></textarea>
					</div>
				</div>
                <div class="form-group">
				<p class="small label help-block gal"><i class="fa fa-info-circle text-primary"></i>
                             Di isi link youtube lengkap seperti contoh dibawah ini<br /><i class="fa fa-film text-info"></i> https://www.youtube.com/watch?v=iWO92inNsvw </p>
				           	<img class="rounded mx-auto img-fluid d-block mb-1" style="width: 200px;" src="" />
							
						
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
			url : '<?= $getone ?>',
			data : {id:id},
			dataType:'JSON',
			success: function(data) {
			    $('.preloader-wrapper').hide();
				$('#modalEdit').modal('show');
		        $('#modalEdit').find('.modal-body').find('input[name="edit[id]"]').val(data.id);
                $('#modalEdit').find('.modal-body').find('textarea[name="edit[description]"]').val(data.description);
                $('#modalEdit').find('.modal-body').find('img').attr('src', data.img);
			}
		});
	}
    function baru(id){
                $('#modalEdit').modal('show');
                $('#modalEdit').find('.modal-body').find('input[name="edit[id]"]').val('');
                $('#modalEdit').find('.modal-body').find('textarea[name="edit[description]"]').val('');
                $('#modalEdit').find('.modal-body').find('img').attr('src', '<?= Dee::$app->baseUrl ?>/public/assets/images/no-image/poster.jpg');
        }
        
 
   
</script>
