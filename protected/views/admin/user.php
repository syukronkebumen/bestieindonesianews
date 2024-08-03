<?php
/* @var $this \dee\base\View */
$this->title = 'User';
?>
<div class="home">
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Full Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user['id']?></td>
            <td><?= $user['username']?></td>
            <td><?= $user['fullname']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>