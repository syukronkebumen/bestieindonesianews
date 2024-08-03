
<div class="row">
	 

<div class="col-sm-12 hilangq detail" id="detail">
		<div class="card">
			<div class="card-header">
		        <div class="row">
		            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
		                <h3 class="card-title"><?php echo ucwords($form_title);?></h3>
		            </div>
		            <div class="col-md-6 col-12 d-flex d-md-block justify-content-center mb-md-0 mb-2">
		                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <form method="POST" action="<?php echo $form_action_agenda;?>">
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
					<th>Agenda</th>
					<th>Tanggal Pelaksanaan</th>
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
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": false,
		"info": false,
		"autoWidth": true,
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

