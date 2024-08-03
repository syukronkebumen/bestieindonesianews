<form action="<?php echo $action_url;?>" autocomplete="off" method="POST" class="ajax">
<div class="card">
	<div class="card-header">
        <div class="row">
            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-md-start align-items-center mb-3 mb-md-0">
                <h3 class="card-title"><?php echo ucwords($title);?></h3>
            </div>
            
        </div>
    </div>
  		<input type="hidden"  name="pages[pages_id]" value="<?php echo isset($pages_id) ? $pages_id : NULL;?>" />
        <input type="hidden"  name="pages[type]" value="0" />
   
    <div class="row justify-content-center">
		<div class="col-sm-8">
		
            
	
		<div class="form-group">
				<label class="d-block link"><?php echo isset($type) && ($type == 1) ? "Link / URL" : 'Judul Content';?> </label>
				<input type="text" class="form-control form-control-sm" name="pages[title]" required="required"  value="<?php echo isset($title_m) ? $title_m : NULL;?>" />
		
			</div>
			
			<div id="content" class="form-group" <?php echo isset($type) && ($type == 1) ? "style='display:none;'" : NULL;?>>
				<label class="d-block">Isi Content</label>
				<textarea class="form-control form-control-sm summernote" name="pages[content]" rows="3"><?php echo isset($content) ? $content : NULL;?></textarea>
			</div>
		<div class="col-md-6 col-6 d-flex d-md-block justify-content-center mb-md-0 mb-2">
                <div class="btn-group  btn-block" role="group">
                    <a href="javascript:history.back()" class="btn btn-outline-primary"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-info">Simpan <i class="fa fa-fw fa-save"></i></button>
                    <input type="hidden" name="pages[parent]" value="5" /> 
                </div>
            </div>
		</div>
         
	</div>
</div>
</form>
<script>

</script>
