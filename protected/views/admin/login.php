<?php
/* @var $this \dee\base\View */
$this->title = 'Login';
?>
<form method="post">
    <div class="form-group">
        <?= $message ?>
    </div>
    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" name="username" value="<?= $username ?>" class="form-control"
               id="user_name" placeholder="User Name">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" value="<?= $password ?>"
               class="form-control" id="password" placeholder="Password">
    </div>
    <div class="row">
                                    		<div class="col-sm-4">
                                    			<div class="form-group">
                                    				<label class="d-block">Captcha</label>
                                            		<img src="<?php echo $_SESSION['captcha']['image_src'];?>" class="img-fluid" alt="">
                                    			</div>
                                    		</div>
                                    		<div class="col-sm-8">
		                                    	<div class="form-group">
		                                            <label class="d-block">Masukkan kode captcha</label>
		                                            <input type="text" class="form-control" name="captcha" required="required">
		                                        </div>
                                    		</div>
                                    	</div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>