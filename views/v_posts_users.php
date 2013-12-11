<img src="/images/V_Logo_75.png" alt="logo" width="70" height="70" class="logo4">

<div id="postfollow">

<?php foreach($users as $user): ?>

    <!-- Print this user's name -->
    <h2><?=$user['first_name']?> <?=$user['last_name']?></h2>

    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$user['user_id']])): ?>
        <h3><a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a></h3>

    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        <h3><a href='/posts/follow/<?=$user['user_id']?>'>Follow</a></h3>
    <?php endif; ?>

    <br>

<?php endforeach; ?>
</div>