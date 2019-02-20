<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('pagecontent'); ?>
    <?php if (session('flashmessage')) : ?>
    <div style="max-width: 322px; margin: 0 auto">
    <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <?php echo e(session('flashmessage')); ?>

    </div>  
    </div>
    <?php endif; ?>

    <?php if($errors->has('email')): ?>
        <div style="max-width: 322px; margin: 0 auto">
            <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <?php echo e($errors->first('email')); ?>

            </div>  
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('user.auth.authenticate')); ?>" method="POST" class="sign-box" id="form-signin_v1" name="form-signin_v1" method="POST" >
        <div class="sign-avatar">
            <img src="<?php echo e(asset ('public/user/img/logo.png')); ?>" alt="">
        </div>
        <header class="sign-title">Log In for User</header>
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <input  type="email" 
                    value ="admin@camcyber.com" 
                    class="form-control" 
                    placeholder="Enter Email or Phone Number"
                    required
                    name="email" />
        </div>
        <div class="form-group">
            <input type="password" 
                    class="form-control" 
                    value = "123456"
                    placeholder="Enter Your Password"
                    required
                    name="password" />
        </div>
        <div class="form-group">
            <div class="checkbox float-left">
                <input type="checkbox" id="signed-in" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                <label for="signed-in">Keep me signed in</label>
            </div>
            <div class="float-right reset">
                <!--<a href="<?php echo e(route('user.auth.forgot-password')); ?>">Reset Password</a>-->
            </div>
        </div>
        <button type="submit" class="btn btn-inline">Log In</button>
        
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user/layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>