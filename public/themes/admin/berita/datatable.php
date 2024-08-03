<div class="card">
	<div class="card-header">
        <div class="row">
            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
                <h3 class="card-title"><?php echo ucwords($title);?></h3>
            </div>
            <div class="col-md-6 col-12 d-flex d-md-block justify-content-center mb-md-0 mb-2">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button type="button" class="btn btn-outline-primary btn-refresh-table"><i class="fa fa-sync-alt fa-fw"></i></button>
                    <a class="btn btn-outline-primary" href="<?php echo $add_url;?>"><i class="fa fa-plus fa-fw"></i> Tambah</a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
              <table id="data_table" class="display dataTable nowrap">
                <thead>
                <tr>
					<th>Title</th>
					<th>Category</th>
                    <th>gambar</th>
					<th>Action</th>
                </tr>
                </thead>
              </table>
            </div>
</div>


<script>
$(function () {
	$('#data_table').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": true,
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


</script>