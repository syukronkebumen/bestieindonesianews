<form action="<?php echo $action_url;?>" autocomplete="off" method="POST" class="ajax">
<div class="card">
	<div class="card-header">
        <div class="row">
            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
                <h3 class="card-title"><?php echo ucwords($title);?></h3>
            </div>
            
        </div>
    </div>
  		<input type="hidden"  name="agenda[agenda_id]" value="<?php echo isset($agenda_id) ? $agenda_id : NULL;?>" />
    <div class="row justify-content-center">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Tema Agenda </label>
				<textarea class="form-control form-control-sm" name="agenda[tema]" rows="2"> <?php echo isset($tema) ? $tema : NULL;?> </textarea>
			</div>
            
	  
	<div class="form-group">
	 <label class="d-block">Tanggal Pelaksanaan</label>
	 <div class="input-group flatpickr_date">
	  <input type="text" class="form-control" name="agenda[tgl_pelaksanaan]" value="<?php echo isset($tgl_pelaksanaan) ? $tgl_pelaksanaan : NULL;?>" data-input/>
		  <div class="input-group-append">
		      <button class="btn btn-outline-info" type="button"><i class="fa fa-calendar"></i></button>
		     </div>
		     </div>
		       </div>
               <div class="form-group">
	 <label class="d-block">Waktu </label>
	 <div class="input-group flatpickr_time">
	  <input type="text" class="form-control" name="agenda[waktu]" value="<?php echo isset($waktu) ? $waktu : NULL;?>" data-input/>
		     </div>
		       </div>
				<div class="form-group">
				<label class="d-block link">Lokasi Agenda </label>
			<textarea class="form-control form-control-sm " name="agenda[tempat]" rows="2"><?php echo isset($tempat) ? $tempat : NULL;?></textarea>
		
			</div>
            
			<div id="content" class="form-group"> 
				<label class="d-block">Detail Agenda</label>
				<textarea class="form-control form-control-sm summernote" name="agenda[detail]" rows="2"><?php echo isset($detail) ? $detail : NULL;?></textarea>
			</div>
		<div class="col-md-6 col-6 d-flex d-md-block justify-content-center mb-md-0 mb-2">
                <div class="btn-group  btn-block" role="group">
                    <a href="javascript:history.back()" class="btn btn-outline-primary"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-info">Simpan <i class="fa fa-fw fa-save"></i></button>
                    
                </div>
            </div>
		</div>
         
	</div>
</div>
</form>
<script>

</script>
