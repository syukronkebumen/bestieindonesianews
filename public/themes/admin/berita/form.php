<form action="<?php echo $action_url; ?>" autocomplete="off" method="POST" class="ajax">
	<div class="card">
		<input type="hidden" name="artikel[id]" required="required" value="<?php echo isset($artikel['id']) ? $artikel['id'] : NULL; ?>" />
		<div class="row justify-content-center">
			<div class="col-sm-8">
				<div class="form-group">
					<label>Judul Berita</label>
					<input type="text" class="form-control form-control-sm " name="artikel[title]" required="required" value="<?php echo isset($artikel['title']) ? $artikel['title'] : NULL; ?>" />
				</div>
				<div class="form-group">
					<label class="d-block">Isi Berita</label>
					<textarea class="form-control form-control-sm summernote" name="artikel[content]" rows="3"><?php echo isset($artikel['content']) ? $artikel['content'] : NULL; ?></textarea>
				</div>
				<div class="form-group">
					<label>Caption</label>
					<input type="text" class="form-control form-control-sm " name="artikel[caption]" value="<?php echo isset($artikel['caption']) ? $artikel['caption'] : NULL; ?>" />
				</div>

			</div>
			<div class="col-sm-4">
				<div class="col-sm-12 mb-4" style="background: #c3dbdd;padding: 15px;">
					<div class="form-group">
						<label class="d-block">Photo Utama</label>
						<input type="file" id="inputFile" name="file" class="form-image custom-file-input" />
						<label class="custom-file-label" for="inputFile" style="top: 37px;"></label>
						<?php
						$photo = isset($artikel["img_header"]) && is_file(Dee::$app->basePathe . '/uploads/artikel/thumb/' . $artikel["img_header"]) ?
							Dee::$app->baseUrl . '/public/uploads/artikel/thumb/' . $artikel["img_header"] : Dee::$app->baseUrl . '/public/assets/images/no-image/poster.jpg';
						?>
						<img class="rounded mx-auto img-fluid d-block mb-1" src="<?php echo $photo; ?>" />
						<p class="help-block text-center"><small> Recomended dimention 700x450 pixel and max filesize 2.0MB</small></p>
					</div>
					<div class="form-group">
						<div class="card-header m-0">
							<h3 class="card-title">Category</h3>
						</div>
						<style>
							.editable-container.editable-inline {
								width: 80%;
							}
						</style>
						<div class="pr-0 pl-0 pb-0">
							<ul class="hak-akses" style="padding: 0;list-style: none;">
								<?php foreach ($category as $val) {
									$cc = $val["value_id"] == 95 && empty($artikel['category']) ? 'checked' : null;
								?>
									<li class="mb-2"><input type="radio" name="artikel[category]" value="<?php echo $val["value_id"]; ?>" <?php echo !empty($artikel['category']) && ($artikel['category'] == $val["value_id"]) ? "checked" : $cc; ?> />
										<a href="#" class="editable" e-style="width: 100%" data-name="artikel" data-type="text" data-pk="<?php echo $val["value_id"]; ?>" data-url="<?= Dee::createUrl('admin/value/update') ?>"><?php echo ($val["value_id"]) ? htmlentities(ucfirst($val["isi"])) : ucfirst($val["isi"]); ?></a>
										<!--  <button id="delete" type="button" class="btn btn-sm btn-flat btn-outline-info fa-pull-right" onclick="remove('<?= $val['value_id'] ?>','<?= $delete_url ?>')"><i class="fa fa-trash"></i></button>
                       -->
									</li>
								<?php }  ?>
								<li><a href="#" class="editable" e-style="width: 100%" data-name="artikel" data-type="text" data-pk="0" data-url="<?= Dee::createUrl('admin/value/update') ?>"></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="btn-group float-md-right" role="group">
					<a href="javascript:history.back()" class="btn btn-outline-primary"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
					<button type="submit" class="btn btn-outline-primary">Simpan <i class="fa fa-fw fa-save"></i></button>
				</div>


			</div>
		</div>
	</div>
</form>