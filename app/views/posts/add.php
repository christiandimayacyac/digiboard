<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <a href="<?php echo URLROOT ;?>/posts"><i class="fa fa-backward"></i> Back</a>
        <div class="card card-body bg-light mt-3">
            <?php flash('post-message'); ?>
            <span><?php echo (!empty($data['post_session_err']) ? $data['post_session_err'] : '');?></span>
            <h2 class="post__header text-center">Add Post</h2>
            <p>Please enter the post title and post body in this form.</p>
            <form action="<?php echo URLROOT . '/posts/add'; ?>" class="add_post-form" method="POST">
                <div class="form-group">
                    <label for="post_title">Post Title: <sup>*</sup></label>
                    <input type="text" name="post_title" class="form-control form-control-lg <?php echo (!empty($data['post_title']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['post_title']; ?>" required>
                    <span><?php echo (!empty($data['post_title_err']) ? $data['post_title_err'] : '');?></span>
                </div>
                <div class="form-group">
                    <label for="post_body">Post Body <sup>*</sup></label>
                    <textarea name="post_body" class="form-control form-control-lg <?php echo (!empty($data['post_body']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['post_body']; ?>" rows="5" required></textarea>
                    <span><?php echo (!empty($data['post_body_err']) ? $data['post_body_err'] : '');?></span>
                </div>
                <input type="hidden" name="uid" <?php echo (!empty($_SESSION['user_id']) ? 'is-invalid' : ''); ?>" value="<?php echo $_SESSION['user_id']; ?>">
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Submit Post" class="btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php  require APPROOT . '/views/inc/footer.php'; ?>