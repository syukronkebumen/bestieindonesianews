<div class="card card-table">
    <div class="card-header">
        <h3 class="card-title"><?php echo ucwords($title);?></h3>

    </div>

    <div class="row">
    	<div class="col-md-8">
            <div class="table-responsive" style="border: 1px solid rgba(0,0,0,.125); border-radius: 5px; overflow: hidden;">
            	<table class="table table-striped table-borderless">
            	<tr>
            	<td><div class="row" style="margin-left: 0px;">
					<label class="col-sm-3" >Username <span class="kanan">:</span></label>
                 	<div class="col-sm-8">
                     <?php echo ($id) ? htmlentities($username) : $username;?>
                    </div>
				    </div>
                </td>
            	</tr>

            	<tr>
            	<td><div class="row" style="margin-left: 0px;">
	                <label class="col-sm-3" >Nama <span class="kanan">:</span></label>
	                <div class="col-sm-9">
                     <a href="#"
							class="editable"
							e-style="width: 100%"
							data-name="fullname"
							data-type="text"
							data-pk="<?php echo $id;?>"
							data-url="<?= Dee::createUrl($update_url)?>"><?php echo ($id) ? htmlentities($fullname) : $fullname;?></a>
                    </div>
	                </div>
                </td>
            	</tr>
            	<tr>
            	<td><div class="row" style="margin-left: 0px;">
	                <label class="col-sm-3" >Email <span class="kanan">:</span></label>
	                <div class="col-sm-9">
                    <a href="#"
							class="editable"
							e-style="width: 100%"
							data-name="email"
							data-type="text"
							data-pk="<?php echo $id;?>"
							data-url="<?= Dee::createUrl($update_url)?>"><?php echo ($id) ? htmlentities($email) : $email;?></a>
				    </div>
	            </div>
                </td>
            		</tr>
            		<tr>
            		<td><div class="row" style="margin-left: 0px;">
                    <label class="col-sm-3" >Foto User <span class="kanan">:</span></label>
	                <div class="col-sm-9">
                        <img src="<?php echo isset($image) && !empty($image) ? Dee::$app->baseUrl.'/public/uploads/administrator/'.$image : Dee::$app->baseUrl .'/public/assets/images/no-image/avatar.png'; ?>" style="width: 100%; max-width: 130px; border-radius: 50%;"></td>
            		<div></div></tr>
            	</table>





            </div>
    	</div>
    	<div class="col-md-4">
    		<div class="card" style="background: #c3dbdd;">
            <button type="button" class="btn btn-info btn-block text-white" style="font-size: 13px;" data-toggle="modal" data-target="#modalUpload">
					<i class="fa fa-fw fa-upload"></i> Upload Foto Profile </button>
              <button type="button" class="btn btn-info btn-block text-white" style="font-size: 13px;" data-toggle="modal" data-target="#modalPassword">
					<i class="fa fa-sync"></i> Ubah Password </button>
               	</div>
    	</div>
    </div>
</div>
<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-md" role="document">
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
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Rubah Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="<?= Dee::createUrl($updatePw_url) ?>" autocomplete="off" method="POST" class="ajax" style="border: 1px solid rgba(0,0,0,.125); font-size:12px; border-radius: 5px; overflow: hidden; padding: 20px;">
				<div class="form-group">
					<label>Password Baru</label>
					<div class="input-group">
						<input type="password" class="form-control form-control-sm" name="edit[passwordbaru]" placeholder="ketik password baru anda" required />
						<div class="input-group-append">
							<button type="button" class="btn btn-default btn-show-password btn-sm" style="border: 1px solid #ced4da; border-left: none;"><i class="fa fa-eye"></i></button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Ulangi Password Baru</label>
					<div class="input-group">
						<input type="password" class="form-control form-control-sm" name="edit[passwordulang]" placeholder="ulangi ketik password baru anda" required/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default btn-show-password btn-sm" style="border: 1px solid #ced4da; border-left: none;"><i class="fa fa-eye"></i></button>
						</div>
					</div>
				</div>
	           <div class="form-group">
                 	<div class="row">
                     	<div class="col-sm-4">
                        	<img src="<?php echo $_SESSION['captcha']['image_src'];?>" class="img-fluid" alt="">
                                    		</div>
                                    		<div class="col-sm-8">
		                                             <input type="text" class="form-control form-control-sm" name="captcha" placeholder="Code captcha" required="required">
		                                 	</div>
                                    	</div>
		                                    </div>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-save"></i> Save</button>
			</div>
            </form>
		</div>
	</div>
</div>

<script type="text/javascript">
Dropzone.autoDiscover = false;
$(document).ready(function(){
	$("#upload").dropzone({
		url: "<?= Dee::createUrl($upload_url)?>",
		maxFilesize: 5,
		dictDefaultMessage:"<i class='fa fa-upload '></i><p>Upload Foto Profile di here <small>(click or drop files)</small></p>",
		success: function(file, response){
			Swal.fire({
									position: 'center',
									icon: 'success',
									title: response.message,
									showConfirmButton: false,
									timer: 1000
								})
		},
		error : function(file, response){
			Swal.fire({
										position: 'center',
										icon: 'error',
										title: response.message,
										showConfirmButton: false,
										timer: 1000
									})
		},
		queuecomplete : function (file,response) {
			setTimeout(function(){
				location.reload();
			},1000);
		}
	});


});

</script>
