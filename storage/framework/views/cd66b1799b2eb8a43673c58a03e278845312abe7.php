<?php $__env->startSection('content'); ?>

<?php if( session('status') && session('type') == 'success' ): ?>
    <div class="alert alert-success text-center" role="alert">
        <strong><?php echo e(session('status')); ?></strong>
    </div>
<?php endif; ?>

<?php if( session('status') && session('type') == 'error' ): ?>
    <div class="alert alert-danger text-center" role="alert">
        <strong><?php echo e(session('status')); ?></strong>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <a role="button" class="btn btn-primary" href="<?php echo e(action('SchedulesController@new')); ?>">
            <i class="fa fa-plus-circle fa-fw"></i>Novo horário
        </a>    
    </div>
</div>

<br />

<table class="table table-sm table-hover table-responsive">
    <thead>
        <tr>
            <th>Letra</th>
            <th colspan="2">Horário</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($schedule->letter); ?></td>
            <td><i><?php echo e($schedule->time_range); ?></i></td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="<?php echo e(action('SchedulesController@edit', ['id' => $schedule->id])); ?>"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="<?php echo e(action('SchedulesController@delete', ['id' => $schedule->id])); ?>">
                        <?php echo e(csrf_field ()); ?>

                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-<?php echo e($schedule->id); ?>" type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<nav aria-label="...">
    <ul class="pagination pagination-sm justify-content-center">      
        <?php if( $schedules->currentPage() > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e(action('SchedulesController@index')); ?>?page=<?php echo e($schedules->currentPage() - 1); ?>">Anterior</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Anterior</span>
            </li>
        <?php endif; ?>

        <?php for( $cont = 0; $cont < $schedules->lastPage(); $cont++ ): ?>
            <?php if( $schedules->currentPage() == $cont + 1): ?>
                <li class="page-item active"><a class="page-link" href=""><?php echo e($cont + 1); ?></a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="<?php echo e(action('SchedulesController@index')); ?>?page=<?php echo e($cont + 1); ?>"><?php echo e($cont + 1); ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if( $schedules->currentPage() < $schedules->lastPage() ): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e(action('SchedulesController@index')); ?>?page=<?php echo e($schedules->currentPage() + 1); ?>">Próximo</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Próximo</span>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>