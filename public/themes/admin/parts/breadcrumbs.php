<div class="content-header row">
    <div class="content-header-left col-md-8 col-12">
        <h3 class="content-header-title mb-0"><?php echo $title; ?></h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <?php foreach($breadcrumbs AS $val) : ?>
						<li class="breadcrumb-item">
						<?php echo !isset($val['is_active']) || (isset($val['is_active']) && $val['is_active'] == FALSE)  ? '<a href="'. $val['href'] .'">' :NULL;?>
							<?php echo ucwords($val['title']);?>
						<?php echo !isset($val['is_active']) || (isset($val['is_active']) && $val['is_active'] == FALSE)  ? '</a>' :NULL;?>
						</li>
					<?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
    
</div>