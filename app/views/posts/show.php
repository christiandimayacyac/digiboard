<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <?php var_dump($data['post']->user_id); ?> -->
    <a href="<?php echo URLROOT ;?>/posts"><i class="fa fa-backward"></i> Back</a>
    <div class="row">
        <div class="col-md-6">
            <h1 class="mb-4"><?php echo $data['post']->title; ?></h1>
            <span class="post-details">Posted by <?php echo ucwords($data['user']->name);?> on <?php echo ucwords($data['post']->date_posted);?></span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12 mx-auto">
            <div class="card card-body bg-light mt-3">
            <?php echo ucwords($data['post']->body);?>
            </div>
        </div>
    </div>
    <!-- Show Edit and Delete buttons for the post to the author only -->
    <?php if( isLoggedIn() && $data['post']->user_id == $_SESSION['user_id']) : ?>
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
            </div>
            <div class="col-md-6">
                <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST">
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    <?php endif; ?> 


<?php  require APPROOT . '/views/inc/footer.php'; ?>