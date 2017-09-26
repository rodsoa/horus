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
        <a role="button" class="btn btn-primary" href="<?php echo e(action('EmployeesController@new')); ?>">
            <i class="fa fa-plus-circle fa-fw"></i>Novo agente
        </a>

         <a role="button" class="btn btn-secondary" href="<?php echo e(action('EmployeeCategoriesController@index')); ?>">
             Categorias
        </a>       
    </div>
    
    <div class="col-sm-12 col-md-6 col-lg-6">
        <form>
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-cog fa-fw"></i>
                    </button>
                </span>
                <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..." name="search">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Pesquisar</button>
                </span>
            </div>
        </form>
    </div>
</div>

<br />

<table class="table table-sm table-responsive">
    <thead>
        <tr>
            <th>Status</th>
            <th>Nome</th>
            <th>Matrícula</th>
            <th colspan=2>Lotação</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <strong>
                <?php if( $employee->status === 'A' ): ?>
                    <i style="color: #27AE60">ATIVO</i>
                <?php elseif( $employee->status === 'I' ): ?>
                    <i style="color: #CF000F">INATIVO</i>
                <?php elseif( $employee->status === 'F' ): ?>
                    <i style="color: #65878F">FOLGA</i>
                <?php elseif( $employee->status === 'At' ): ?>
                    <i style="color: #6E5D4B">ATESTADO</i>
                <?php else: ?>
                    <i style="color: #F7BC05">FÉRIAS</i>
                <?php endif; ?>
                </strong>
            </td>
            <td><?php echo e($employee->name); ?></td>
            <td><i><?php echo e($employee->registration_number); ?></i></td>
            <td>
                <?php $__currentLoopData = $employee->getActualWorkPlaces(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($name); ?><br/> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="<?php echo e(action('EmployeesController@view', ['registration_number' => $employee->registration_number])); ?>"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="<?php echo e(action('EmployeesController@edit', ['registration_number' => $employee->registration_number])); ?>"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="<?php echo e(action('EmployeesController@delete', ['registration_number' => $employee->registration_number])); ?>">
                        <?php echo e(csrf_field ()); ?>

                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-<?php echo e($employee->id); ?>" type="submit" class="btn btn-danger btn-sm">
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
        <?php if( $employees->currentPage() > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e(action('EmployeesController@index')); ?>?page=<?php echo e($employees->currentPage() - 1); ?>">Anterior</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Anterior</span>
            </li>
        <?php endif; ?>

        <?php for( $cont = 0; $cont < $employees->lastPage(); $cont++ ): ?>
            <?php if( $employees->currentPage() == $cont + 1): ?>
                <li class="page-item active"><a class="page-link" href=""><?php echo e($cont + 1); ?></a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="<?php echo e(action('EmployeesController@index')); ?>?page=<?php echo e($cont + 1); ?>"><?php echo e($cont + 1); ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if( $employees->currentPage() < $employees->lastPage() ): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e(action('EmployeesController@index')); ?>?page=<?php echo e($employee->currentPage() + 1); ?>">Próximo</a>
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