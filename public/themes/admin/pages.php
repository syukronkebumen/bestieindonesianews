<style>.hilang{display: none;}</style>
<div class="row">
	<div class="col-sm-5 hilang">
		<div class="card">
			<div class="card-header">
		        <div class="row">
		            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
		                <h3 class="card-title"><?php echo ucwords($table_title);?></h3>
		            </div>
                         <div class="col-md-6" style="text-align: right;">
		                  <button type="button"  onclick="detail('')" id="det-" class="btn btn-sm btn-outline-primary" style="font-size: 12px;"><i class="fas fa-circle"></i> All isi menu</button>
                        </div>
		        </div>
		    </div>
			<div class="table-responsive ">
		<table class="table table-hover" width="100%">
			<tbody>
			<?php

			foreach($settings AS $val){
			?>
				<tr>
					<td style="width:calc(100% - 190px);">
						<a href="#"
							class="editable"
							e-style="width: 100%"
							data-name="menu"
							data-type="text"
							data-pk="<?php echo $val["value_id"];?>"
							data-url="<?= Dee::createUrl('admin/pages/insert-val');?>"><?php echo ($val["value_id"]) ? htmlentities($val["isi"]) : $val["isi"];?></a>
					</td>
                    <td>
                    <div class="btn-group fa-pull-right">
                    <button type="button"  onclick="remove('<?= $val['value_id'] ?>','<?= $delete_url ?>')" class="btn btn-sm btn-outline-primary" ><i class="fa fa-trash"></i></button>
                    <button type="button"  onclick="detail('<?= $val['value_id'] ?>')"  id="det-<?= $val['value_id'] ?>" class="btn btn-sm btn-outline-primary" style="font-size: 12px;"><i class="fas fa-search"></i> Detail</button>
                </div>
                    </td>
				</tr>
			<?php }  ?>
                  <tr>
					<td style="width:calc(100% - 190px);" colspan="2">
						<a href="#"
							class="editable"
							e-style="width: 100%"
							data-name="menu"
							data-type="text"
							data-pk="0"
							data-url="<?= Dee::createUrl('admin/pages/insert-val');?>"></a>
					</td>

				</tr>

			</tbody>
		</table>
	</div>
 		</div>
	</div>

 

<div class="col-sm-12 hilangq detail" id="detail">
		<div class="card">
			<div class="card-header">
		        <div class="row">
		            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
		                <h3 class="card-title"><?php echo ucwords($form_title);?></h3>
		            </div>
		            <div class="col-md-6 col-12 d-flex d-md-block justify-content-center mb-md-0 mb-2">
		                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <form method="POST" action="<?php echo $form_action_pages;?>">
                            <input type="hidden" id="parent" name="parent" value="<?= $parent ?>" />
		                    <button class="btn btn-outline-primary"  type="submit"><i class="fa fa-plus fa-fw"></i> Add New</button>
                        </form>
		                </div>
		            </div>
		        </div>
		    </div>

			<div class="table-responsive">
              <table id="data_tablet" class="display dataTable nowrap">
                <thead>
                <tr>
					<th>Judul Menu Tampil</th>
					<th>Judul Profile</th>
                    <th>Aksi</th>
                </tr>
                </thead>
              </table>
            </div>
		</div>
	</div>

</div>

<script>
jQuery(document).ready(function($) {
   $('#data_tablet').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"responsive": true,
		"ajax": {
			"url": '<?php echo $table_url;?>',
			"type": "POST",
			"dataType": "json",
			async: "true"
		}
	});

});

function detail(id){

    var iTable = $('#data_tablet').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"responsive": true,
        "bDestroy": true,
		"ajax": {
			"url": '<?php echo $table_url_a;?>'+id,
			"type": "POST",
			"dataType": "json",
			async: "true"
		}
	})

     $('#detail').removeClass('hilang');
     $('#det-'+id).addClass('btn-info text-white');
     $('form').find('#parent').val(id);
     //$('#detail').find('.dataTable').attr('id','table'+id);
     //iTable.ajax.reload(null, true).draw(true);
     iTable.ajax;

}

</script>

