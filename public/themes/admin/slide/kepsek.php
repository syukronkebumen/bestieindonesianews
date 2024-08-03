<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/croppie/croppie.css';?>"/>
   <script src="<?php echo Dee::$app->baseUrl.'/public/assets/croppie/croppie.js';?>"></script>
   
<div class="card">
	<div class="card-header">
		<div class="row">
            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
                <h3 class="card-title"><?php echo ucwords($title);?></h3>
            </div>
            <div class="col-md-6 col-12 d-flex d-md-block justify-content-center mb-md-0 mb-2">
               
            </div>
        </div>
	</div>
    <div class="card-body">
		<hr/>
			<form action="<?php echo $simpan_url ?>" autocomplete="off" method="POST" class="ajax" >
		
	
		<div class="row">
           <div class="col-md-6">
			<div  style="border: 1px solid rgba(0,0,0,.125); font-size:12px; border-radius: 5px; overflow: hidden; padding: 20px;"> 
                <div class="form-group">
					<label >Photo</label>
				            <input type="file" id="inputFile" name="file" class="form-imagec custom-file-input" />
                          	<img class="rounded mx-auto img-fluid d-block mb-1" style="width: 200px;" src="<?= $img ?>" />
							<p class="help-block gal"><i class="fa fa-info-circle text-primary"></i> Recomended dimention 300x400 pixel and max 2.0MB</p>
						
                        <div class="input-group"> <label class="custom-file-label" for="inputFile"></label>	</div>
					</div>
 			
 				</div></div>
                <div class="col-md-6">
            <div  style="border: 1px solid rgba(0,0,0,.125); font-size:12px; border-radius: 5px; overflow: hidden; padding: 20px;"> 
            	<div class="form-group">
					<label>Nama</label>
					<div class="input-group">
                       	<input type="hidden"  name="edit[id]" value="<?= $id ?>" />
                        <input type="hidden"  name="edit[kategori]" value="3" />
                        <input type="hidden"  id="image" name="edit[image_url]" value="<?= $image_url ?>" />
						<input type="text" class="form-control form-control-sm" name="edit[title_img]" value="<?= $title_img ?>" required />

						</div>
			    	</div>
				
	          	<div class="form-group galery">
					<label>Keterangan</label>
					<div class="input-group">
						<textarea class="form-control form-control-sm" rows="5" name="edit[description]" placeholder="Keterangan" /><?= $description ?> </textarea>
					</div>
				</div>
                </div></div>
        
	</div>
    
	<div class="card-footer" style="text-align:center;margin-top: 20px;">
	  <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
       </div>
		
            </form>
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
      width:200,
      height:267,
      type:'square' //circle
    },
    boundary:{
      width:250,
      height:334
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
         
          $('form').find('input[name="edit[image_url]"]').val(data);
          $('form').find('img').attr('src', '<?= Dee::$app->baseUrl ?>/public/uploads/warga/'+data); 
        }
      });
    })
  });               


	
});
               
  
</script>
