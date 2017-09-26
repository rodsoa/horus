<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title">Agentes</h4>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <h6>Ativos: <?php echo e($active_employees); ?></h6>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <h6>Inativos: <?php echo e($inactive_employees); ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/agentes">visualiar</a>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title text-center">Unidades</h4>
                <h6><?php echo e($buildings); ?></h6>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/unidades">visualiar</a>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title text-center">Usuários</h4>
                <h6><?php echo e($users); ?></h6>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/usuarios">visualiar</a>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body  text-center">
                <h4 class="card-title">Relatórios</h4>
                <h6><?php echo e($reports); ?></h6>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/relatorios">visualiar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>