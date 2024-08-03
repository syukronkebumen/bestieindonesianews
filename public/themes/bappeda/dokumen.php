

    <!--Page Title-->
    <section class="page-title" style="background-image:url(./public/assets/images/bg_bappeda.jpeg)">
    	<div class="auto-container">
        	<h2><?= $nav ?></h2>
            <ul class="page-breadcrumb">
            	<li><a href="">home</a></li>
                <li><?= $nav ?></li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<section class="cart-section">
        <div class="auto-container">

            <!--Cart Outer-->
            <div class="cart-outer">
                <div class="table-outer">
                 <table class="cart-table">
                <?php foreach ($folder as $fd): ?>
                <thead class="cart-header">
                <tr><th colspan="3"><i class="fa fa-folder"></i> <?= $fd['isi'] ?> </th></tr>
                 </thead>
      <?php $i = 0;
		foreach ($data['lists'] as $dt):
			if ($fd['value_id'] == $dt['id_album'])
			{
				$i++; ?>
            
      <tr><td> </td> <td><a href="<?= Dee::createUrl('public/uploads/dokumen/' .$dt['image_url']) ?>"> <?= $i .'. ' . $dt['image_url'] ?></a></td>
      <td><a href="<?= Dee::createUrl('public/uploads/dokumen/' . $dt['image_url']) ?>" download >
       <i class="fa fa-download"></i></a> </td></tr>
      
          <?php }	endforeach; ?>
          
	<tr><td colspan="3"><nav class="navigation pagination" aria-label="Posts"> <?= $data['pagination'] ?></nav>	</td></tr>	
        <?php endforeach; ?>
        </table>
                   
                </div>

                
                
			</div>

        </div>
    </section>


