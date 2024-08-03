<div class="card col-md-6 col-12">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
	            <h3 class="card-title"><?php echo ucwords($form_title);?></h3>
	        </div>
		</div>
	</div>
	<div class="table-responsive ">
		<table class="table table-hover" width="100%">
			<tbody>
			<?php
        	$notin = array('logo_image', 'logo_image2','favicon_image','prefooter_image', 'pages_image');
			foreach($settings AS $val){
			if (!in_array($val['thekey'], $notin)) {
			?>
				<tr>
					<td style="width:calc(100% - 20px);">
						<a href="#"
							class="editable" 
							e-style="width: 100%"
							data-name="artikel"
							data-type="text" 
							data-pk="<?php echo $val["value_id"];?>" 
							data-url="<?= Dee::createUrl('admin/value/update')?>"><?php echo ($val["value_id"]) ? htmlentities($val["isi"]) : $val["isi"];?></a>
					</td>
                    <td>
                        <button id="delete" type="button" class="btn btn-sm btn-outline-danger fa-pull-right" onclick="remove('<?= $val['value_id'] ?>','<?= $delete_url ?>')"><i class="fa fa-trash"></i></button>
                    </td>
				</tr>
			<?php } } ?>
                  <tr>
					<td style="width:100%;" colspan="2">
						<a href="#"
							class="editable" 
							e-style="width: 100%"
							data-name="artikel"
							data-type="text" 
							data-pk="0" 
							data-url="<?= Dee::createUrl('admin/value/update')?>"></a>
					</td>
                    
				</tr>
			</tbody>
		</table>
	</div>
</div>
