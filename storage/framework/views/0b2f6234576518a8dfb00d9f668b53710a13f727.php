<?php $__env->startSection('content'); ?>
<h3 class="card-title">Atualizar Usuário</h3>
<form id="needs-validation" action="<?php echo e(action('UsersController@update', ['id' => $user->id])); ?>" method="POST" novalidate>
    <?php echo e(csrf_field()); ?>

    <div class="form-row">
        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="name">Nome do usuário</label>
            <input type="text" class="form-control" id="name-user" name="name" placeholder="Digite com o nome do usuário" value="<?php echo e($user->name); ?>">
            <div class="invalid-feedback">
                Por favor informe um nome para o usuário.
            </div>
        </div>

        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="user-category">Categoria</label>
            <select class="form-control" id="user-category" name="category" Usuário>
                <option value="A" <?php if($user->category == 'A'): ?> selected <?php endif; ?>>ADMINISTRATOR</option>
                <option value="C" <?php if($user->category == 'C'): ?> selected <?php endif; ?>>COORDENADOR</option>
                <option value="P" <?php if($user->category == 'P'): ?> selected <?php endif; ?>>PLANTONISTA</option>
                <option value="Ag" <?php if($user->category == 'Ag'): ?> selected <?php endif; ?>>AGENTE</option>
            </select>
        </div>

        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="name">Email</label>
            <input type="text" class="form-control" id="name-email" name="email" placeholder="Digite com o email do usuário" value="<?php echo e($user->email); ?>">
            <div class="invalid-feedback">
                Por favor informe um email para o usuário.
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="name">Senha</label>
            <input type="text" class="form-control" id="name-password" name="password" placeholder="Digite com a senha do usuário" required>
            <div class="invalid-feedback">
                Por favor defina uma senha para o usuário.
            </div>
        </div>
    </div>
    <a class="btn btn-danger" role="button" href="<?php echo e(action('UsersController@index')); ?>">Cancelar</a>
    <button type="submit" class="btn btn-success">Atualizar usuário</button>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    (function() {
        "use strict";
        window.addEventListener("load", function() {
            var form = document.getElementById("needs-validation");
            form.addEventListener("submit", function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
            }, false);
        }, false);
    }());
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>