<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-5 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2 class="register__header text-center">Create an Account</h2>
            <p>Please fill up the form and click submit to complete the registration.</p>
            <form action="<?php echo URLROOT . '/users/register'; ?>" class="register-form" method="POST">
                <div class="form-group">
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['name']; ?>">
                    <span><?php echo $data['name_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="name">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['email']; ?>">
                    <span><?php echo $data['email_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="name">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['password']; ?>" required>
                    <span><?php echo $data['password_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm_pass" class="form-control form-control-lg <?php echo (!empty($data['confirm_pass_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['confirm_pass']; ?>" required>
                    <span><?php echo $data['confirm_pass_err'];?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Create Account" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <p class="pull-right">Have an account? <a href="<?php echo URLROOT . '/users/login'; ?>">Login</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php  require APPROOT . '/views/inc/footer.php'; ?>