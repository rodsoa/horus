<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email" class="col-md-12 control-label">Endereço de Email</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <label for="password" class="col-md-6 control-label">Senha</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" required>

                        <?php if($errors->has('password')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Lembre-se de mim
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            Entrar no Sistema
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>