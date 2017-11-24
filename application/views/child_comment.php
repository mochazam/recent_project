<?php if( !empty($child_comment) ) { ?>
    <?php foreach ($child_comment as $child) { ?>
        <li class='comment_box'>
            <div class='aut'><?php echo $child['comment_name'] ?></div>
            <div class='aut'><?php echo $child['comment_email'] ?></div>
            <div class='comment-body'><?php echo $child['comment_body'] ?></div>
            <div class='timestamp'><?php echo date("F j, Y", $child['comment_created']) ?></div>
            <a href='#comment_form' class='reply' id='<?php echo $child['comment_id'] ?>'>Reply</a>
            <ul>
                <?= Modules::run('blog/comment/child_comment',$child['entry_id'],$child['comment_id']); ?>
            </ul>
        </li>

    <?php } } ?>