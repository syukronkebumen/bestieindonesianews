<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/croppie/croppie.css';?>"/>
   <script src="<?php echo Dee::$app->baseUrl.'/public/assets/croppie/croppie.js';?>"></script>
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
        <table id="data_table" class="display dataTable no-footer dtr-inline" role="grid">
                <thead>
                <tr role="row"><th> No. </th> <th>Foto </th><td> Nama </th><th>Jabatan</th><th>Aksi </th> </tr>
                </thead>
			<?php
            $n=0;
			foreach($lists AS $val ) :
            $n++;    
				$image = (
						isset($val['image_url']) &&
						file_exists(Dee::$app->basePathe.'/uploads/warga/' . $val['image_url']) &&
						is_file(Dee::$app->basePathe.'/uploads/warga/'  . $val['image_url'])
					)
					? Dee::$app->baseUrl.'/public/uploads/warga/' . $val['image_url']
					: Dee::$app->baseUrl .'/public/assets/images/no-image/poster.jpg';
			?>
            
            <tr>
            <td><?= $n;?></td> 
            <td><img src="<?php echo $image;?>" class="img-fluid" style="width: 100%;"/> </td>
            <td><?php echo $val['title_img'];?> </td>
            <td><?php echo $val['description'];?></td>
            <td><div class="btn-group btn-group-sm  w-100">
			                 <button class="btn btn-info " style="border-radius: 0; font-size: 12px;" data-id="" onclick="edit('<?php echo $val['id'];?>')"> Edit</button>
					               <button class="btn btn-danger" style="border-radius: 0; font-size: 12px;" type="button"onclick="remove('<?php echo $val['id'];?>','<?= $delete_url ?>')">Delete</button>
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
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Edit Image</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="<?php echo $simpan_url ?>" autocomplete="off" method="POST" class="ajax" style="border: 1px solid rgba(0,0,0,.125); font-size:12px; border-radius: 5px; overflow: hidden; padding: 20px;">
				<div class="form-group">
					<label>Nama</label>
					<div class="input-group">
                       	<input type="hidden"  name="edit[id]"  />
                        <input type="hidden"  name="edit[kategori]"  />
                        <input type="hidden"  id="image" name="edit[image_url]"  />
                        <input type="hidden"    name="edit[status]"  />
						<input type="text" class="form-control form-control-sm" name="edit[title_img]" placeholder="Nama" required />

						</div>
			    	</div>
				
	          	<div class="form-group galery">
					<label>Jabatan</label>
					<div class="input-group">
						<textarea class="form-control form-control-sm" name="edit[description]" placeholder="Jabatan" /></textarea>
					</div>
				</div>
                <div class="form-group">
					<label>Group Jabatan</label>
					<div class="input-group">
                        <select class="form-select form-control select2" name="edit[id_album]">
		                                                <option value="">Silahkan Pilih Group Jabatan</option>
		                                                <option value="1" >Kepala Dinas</option>
		                                                <option value="2" >Sekretaris Kantor</option>
		                                                <option value="3" >Kepala Bidang</option>
		                                                <option value="4" >Kepala Seksi / Sub Bagian</option>
		                                                <option value="5" >Fungsional</option>
		                                                <option value="6" >Lainnya</option>
		                                            </select>
						</div>
			    	</div>
                <div class="form-group">
					<label >Photo</label>
				            <input type="file" id="inputFile" name="file" class="form-imagec custom-file-input" />
                          	<img class="rounded mx-auto img-fluid d-block mb-1" style="width: 200px;" src="" />
							<p class="help-block gal"><i class="fa fa-info-circle text-primary"></i> Recomended dimention 300x400 pixel and max 2.0MB</p>
						
                        <div class="input-group"> <label class="custom-file-label" for="inputFile"></label>	</div>
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
 <div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header bg-info text-white">
        		<h4 class="modal-title"> Crop Image & Upload </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
            <div class="card-body">
        		<div class="row">
  					
						  <div id="image_demo" style="height: auto;"></div>
  					
  					<div class="col-md-12" >
  					
						  <button class="btn btn-success btn-block a-href-btn btn-sm crop_image">Crop & Upload Image</button>
					</div>
				</div>
      		</div>
      	
    	</div>
    </div>
</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
   $image_crop = $('#image_demo').croppie({
    enableExif: true,
   viewport: {
      width:210,
      height:260,
      type:'square' //circle
    },
    boundary:{
      width:250,
      height:290
    }
  });

  $('#inputFile').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
    $('#modalEdit').modal('hide');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"<?= $upload_warga ?>",
        type: "POST",
        data:{"image": response, "ubah_image": true  },
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#modalEdit').modal('show');
          $('#modalEdit').find('.modal-body').find('input[name="edit[image_url]"]').val(data);
          $('#modalEdit').find('.modal-body').find('img').attr('src', '<?= Dee::$app->baseUrl ?>/public/uploads/warga/'+data); 
        }
      });
    })
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
                $('#modalEdit').find('.modal-body').find('input[name="edit[image_url]"]').val(data.image_url);
                $('#modalEdit').find('.modal-body').find('input[name="edit[title_img]"]').val(data.title_img);
                $('#modalEdit').find('.modal-body').find('textarea[name="edit[description]"]').val(data.description);
                $('#modalEdit').find('.modal-body').find('option[value="'+data.id_album+'"]').attr('selected','');
                $('#modalEdit').find('.modal-body').find('img').attr('src', '<?= Dee::$app->baseUrl ?>/public/uploads/warga/'+data.image_url);
			    $('#modalEdit').find('.modal-body').find('input[name="edit[status]"]').val(data.status);
 		}
		});
	}
    function baru(id){
                $('#modalEdit').modal('show');
                $('#modalEdit').find('.modal-body').find('input[name="edit[id]"]').val('');
                $('#modalEdit').find('.modal-body').find('input[name="edit[kategori]"]').val(id);
                $('#modalEdit').find('.modal-body').find('input[name="edit[status]"]').val('0');
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
