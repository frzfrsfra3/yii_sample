<!-- views/user/index.php -->
<h1>User List</h1>
<ul>
    <?php foreach ($users as $user): ?>
        <li><?= $user->username ?></li>
    <?php endforeach; ?>
</ul>
