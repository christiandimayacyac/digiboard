<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-12"><?php echo flash('post_success'); ?></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1 class="mb-4"><?php echo $data['page_title']; ?></h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT;?>/posts/add" class="btn btn-primary pull-right">Add Post</a>
        </div>
    </div>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="card card-body mb-3">
            <h4><?php echo $post->title; ?></h4>
            <!-- <div class="bg-light p-2 mb-3"><?php echo $post->body; ?></div> -->
            <div class="bg-light p-2 mb-3">Posted by <?php echo $post->name;?> on <?php echo $post->date_posted; ?></div>
            <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark text-center p-1">Read</a>
        </div>
    <?php endforeach; ?>
    
    


<?php  require APPROOT . '/views/inc/footer.php'; ?>