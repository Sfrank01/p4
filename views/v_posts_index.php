<img src="/images/V_Logo_75.png" alt="logo" width="70" height="70" class="logo4">
<div id ="article">

<?php foreach($posts as $post): ?>



    <h1><?=$post['first_name']?> <?=$post['last_name']?> posted:</h1>

    <p><?=$post['content']?><br><br>

    <em><time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time></em>
	


<?php endforeach; ?>
</div>
