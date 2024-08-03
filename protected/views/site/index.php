<?php
/* @var $this \dee\base\View */
$this->title = 'Welcome';
$route = 'admin/site/user';
if (($pos = strrpos($route, '/')) !== false) {
            $id = substr($route, 0, $pos);
            $route = substr($route, $pos + 1);
       
        }
        $posi = strrpos($id, '/');
        if ($posi === false) {
            $className = $id;
            $prefix = '';
        } else {
            $prefix = substr($id, 0, $posi + 1);
            $className = substr($id, $posi + 1);
        }
        $className = str_replace(' ', '', ucwords(str_replace('-', ' ', $className)));
            
        echo $id. '<br/>' .$route. '<br/>';
        echo $prefix. '<br/>' .$className. '<br/>';
        echo ltrim($route, '/');
       
?>
<div class="home">

    <div class="jumbotron">
        <h1>Congratulations! <?= @app . @web ?></h1>

        <p class="lead">You have successfully created your own application.</p>

        <p><a href="https://mdmunir.wordpress.com" class="btn btn-lg btn-success">Get started</a>
            <a href="<?= Dee::createUrl('pages/{page}', ['page'=>'about'])?>" class="btn btn-lg btn-success">About</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
        </div>

    </div>
</div>