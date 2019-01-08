<?php 
    require APPROOT . '/views/inc/header.php';
?>

<h1><?php echo $data['title']; ?></h1>
<p>Developed by: <?php echo $data['developer']; ?></p>
<p>Version: <strong><?php echo APP_VERSION; ?></strong></p>

<?php 
    require APPROOT . '/views/inc/footer.php';
?>