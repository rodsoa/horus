<?php $__env->startSection("content"); ?>

<h3 class="card-title text-center">Exibindo usuário <?php echo e($user->name); ?> ( <?php echo e($user->email); ?> )</h3>

<div class="row justify-content-center">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card card-body">
            
            <p class="card-text">
                <table class="table table-sm table-hover">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="2">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nome: </th>
                            <td class="text-right"><?php echo e($user->name); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Categoria: </th>
                            <td class="text-right">
                                <?php if($user->category == 'A'): ?> 
                                    ADMINISTRADOR
                                <?php elseif($user->category == 'C'): ?> 
                                    COORDENADOR
                                <?php elseif($user->category == 'P'): ?> 
                                    PLANTONISTA
                                <?php else: ?>
                                    AGENTE
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Email: </th>
                            <td class="text-right"><?php echo e($user->email); ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php if( Auth::user()->category !== 'Ag' ): ?>
                    <a role="button" class="btn btn-info btn-block" href="<?php echo e(action('UsersController@edit', ['id' => $user->id])); ?>">Atualizar usuário</a>
                <?php endif; ?>
                <a role="button" class="btn btn-secondary btn-block" href="<?php echo e(action('UsersController@index')); ?>">Voltar</a>
            </p>
        </div>
        <br />
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.base", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>