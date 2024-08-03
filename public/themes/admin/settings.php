<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
				<h3 class="card-title"><?php echo ucwords($title); ?></h3>

			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="table-responsive col-sm-8">
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">URL <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="web" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo $web; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Instansi <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="instansi" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($instansi) : $instansi; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Motto <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="kec" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($kec) : $kec; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Alamat <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="alamat" data-type="textarea" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($alamat) : $alamat; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Description <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="description" data-type="textarea" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($description) : $description; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Telephone <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="hp" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($hp) : $hp; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Facebook <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="facebook" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($facebook) : $facebook; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Instagram <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="instagram" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($instagram) : $instagram; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Youtube <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="youtube" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($youtube) : $youtube; ?></a>
				</div>
			</div>
			<div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Twitter <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<a href="#" class="editable" e-style="width: 100%" data-name="twitter" data-type="text" data-pk="<?php echo $id; ?>" data-url="<?= Dee::createUrl('admin/settings/update') ?>"><?php echo ($id) ? htmlentities($twitter) : $twitter; ?></a>
				</div>
			</div>
			<!-- <div class="row" style="padding: 0.52rem;">
				<label class="col-sm-3" style="margin-bottom: 0; font-weight: bold;">Template <span class="kanan">:</span></label>
				<div class="col-sm-8">
					<div class="row">
						<?php foreach ($thema as $template) {
							if ($theme == $template) {
								$opc = '';
								$cek = '<button type="button"  class="btn btn-block btn-info " >Aktif <i class="fa fa-fw fa-save"></i></button>';
							} else {
								$opc = 'opacity:.5';
								$cek = '<button type="submit"  class="btn btn-block btn-outline-primary " >Pilih <i class="fa fa-fw fa-save"></i></button>';
							} ?>
							<div class="col-md-5" style="margin: 10px; background: #CCCBCB;font-size: 10px;<?= $opc ?>">
								<form action="<?= Dee::createUrl('admin/settings/update') ?>" autocomplete="off" method="POST" enctype="multipart/form-data" class="formThemeItem">
									<div class="form-group">
										<label class="d-block">TEMPLATE : <?= $template ?></label>
										<input type="hidden" name="pk" value="<?= $id ?>" />
										<input type="hidden" name="name" value="theme" />
										<input type="hidden" name="value" value="<?= $template ?>" />

										<img src="<?= Dee::$app->baseUrl . '/public/themes/' . $template . '/theme.jpg' ?>" width="100%" style="margin-bottom: 10px;" class="img-responsive img-thumbnail <?= $opc ?>">
										<br /> <?= $cek ?>

									</div>

								</form>
							</div>
						<?php }  ?>
					</div>
				</div>
			</div> -->
		</div>
		<div class="col-md-4">
			<div class="card" style="background: #c3dbdd;">
				<button type="button" class="btn btn-info btn-block text-white mb-4" style="font-size: 13px;" data-toggle="modal" data-target="#modalUpload">
					<i class="fa fa-fw fa-upload"></i> Ganti Logo </button>

				<?php
				$photo = isset($logo) && is_file(Dee::$app->basePathe . '/uploads/' . $logo) ?
					Dee::$app->baseUrl . '/public/uploads/' . $logo : Dee::$app->baseUrl . '/public/assets/images/logo.png';
				?>
				<img class="rounded mx-auto img-fluid d-block mb-1" src="<?php echo $photo; ?>" />
				<p class="help-block text-center">Recomended dimention 200x200 pixel and max filesize 2.0MB</p>

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

<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function() {
		$("#upload").dropzone({
			url: "<?= Dee::createUrl('admin/settings/logo') ?>",
			maxFilesize: 5,
			dictDefaultMessage: "<i class='fa fa-upload '></i><p>Upload Foto Profile di here <small>(click or drop files)</small></p>",
			success: function(file, response) {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: response.message,
					showConfirmButton: false,
					timer: 1000
				})
			},
			error: function(file, response) {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: response.message,
					showConfirmButton: false,
					timer: 1000
				})
			},
			queuecomplete: function(file, response) {
				setTimeout(function() {
					location.reload();
				}, 1000);
			}
		});

		$('.form-image').on('change', function() {
			$(".save").fadeIn();

		});

	});

	$(".formThemeItem").submit(function(e) {
		e.preventDefault();
		var form = $(this);
		var btnHtml = form.find("[type='submit']").html();
		var url = form.attr("action");
		var data = new FormData(this);
		$.ajax({
			beforeSend: function() {
				form.find("[type='submit']").addClass("disabled").html("<i class='fa fa-spinner fa-pulse fa-fw'></i> Loading ... ");
			},
			cache: false,
			processData: false,
			contentType: false,
			type: "POST",
			url: url,
			data: data,
			dataType: 'JSON',
			success: function(response) {
				form.find("[type='submit']").removeClass("disabled").html(btnHtml);
				if (response.status == "success") {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: response.message,
						showConfirmButton: false,
						timer: 1500
					}).then(function() {

						window.location.reload(true);
					})
				} else {
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: response.message,
						showConfirmButton: false,
						timer: 1500
					})
				}
			}
		});
	});
</script>