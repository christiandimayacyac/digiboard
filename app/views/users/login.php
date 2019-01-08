<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-5 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register-success'); ?>
            <h2 class="register__header text-center">Login</h2>
            <p>Please fill in your credentials to login to your account.</p>
            <form action="<?php echo URLROOT . '/users/login'; ?>" class="register-form" method="POST">
                <div class="form-group">
                    <label for="name">Email: <sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data['email']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['email']; ?>">
                    <span><?php echo (!empty($data['email_err']) ? $data['email_err'] : '');?></span>
                </div>
                <div class="form-group">
                    <label for="name">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['password']; ?>" required>
                    <span><?php echo (!empty($data['password_err']) ? $data['password_err'] : '');?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <p class="pull-right">Don't have an account yet? <a href="<?php echo URLROOT . '/users/register'; ?>">Register</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php  require APPROOT . '/views/inc/footer.php'; ?>