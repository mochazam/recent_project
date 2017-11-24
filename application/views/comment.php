<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jquery Raty usage in PHP - Simple Star Ratting Plugin</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/jquery.raty.css">
</head>
<body>

<script type='text/javascript'>
    $(function () {
        $("a.reply").click(function () {
            var id = $(this).attr("id");
            $("#parent_id").attr("value", id);
            $("#name").focus();
        });
    });
</script>
<style type='text/css'>


    a, a:visited {
        outline:none;
        color:#7d5f1e;
    }

    .clear {
        clear:both;
    }

    #wrapper {
        width:480px;
        margin:0 auto 0 4px;
        padding:15px 0px;
    }

    .comment_box {
        padding:5px;
        border:2px solid #7d5f1e;
        margin-top:15px;
        list-style:none;
    }

    .aut {
        font-weight:bold;
    }

    .timestamp {
        font-size:85%;
        float:right;
    }

    #comment_form {
        margin-top:15px;
    }

    #comment_form input {
        font-size:1.2em;
        margin:0 0 10px;
        padding:3px;
        display:block;
        width:100%;
    }

    #comment_body {
        display:block;
        width:100%;
        height:150px;
    }


</style>
<div id='wrapper'>
    <?php if (!empty($parent_comment)) { ?>

        <ul>
            <?php foreach ($parent_comment as $parent) { ?>
                <li id="comment_box" class='comment_box'>
                    <div class='aut'><?php echo $parent['comment_name'] ?></div>
                    <div class='comment-body'><?php echo $parent['comment_body'] ?></div>
                    <div class='timestamp'><?php echo date("F j, Y", $parent['comment_created']) ?></div>
                    <a href='#comment_form' class='reply' id='<?php echo $parent['comment_id'] ?>'>Reply</a>
                    <ul>
                        <?php echo Modules::run('blog/comment/child_comment', $parent['entry_id'], $parent['comment_id']); ?>
                    </ul>
                </li>

            <?php } ?>
        </ul>
    <?php } ?>

    <div class="contact-form">
        <p class="notice error"><?php $this->session->flashdata('error_msg') ?></p><br />
        <form id="comment_form" action="<?php echo base_url() ?>index.php/comment/add_comment/<?php $entry_one->entry_id ?>" method='post'>
            <label for="comment_name">Name:</label>
            <input type="text" name="comment_name" id='name' value="<?php echo set_value("comment_name") ?>"/>
            <label for="email">E-mail :</label>
            <input type="text" name="comment_email" value="<?php echo set_value("comment_email") ?>" id='email'/>
            <label for="comment">Comment :</label>
            <textarea name="comment_body" value="<?php echo set_value("comment_body") ?>" id='comment'></textarea>
            <input type='hidden' name='parent_id' value="<?php echo set_value("parent_id", "0") ?>" id='parent_id' value='0'/>
            <input type='hidden' name='entry_id' value="<?php echo set_value("entry_id", $entry_one->entry_id) ?>" id='parent_id'/>
            <div id='submit_button'>
                <input type="submit" name="submit" value="add comment"/>
            </div>
        </form>
    </div>
</div>

</body>
</html>