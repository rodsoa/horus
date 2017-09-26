<?php $__env->startSection('content'); ?>

<?php if( session('errors') ): ?>
    <?php $__currentLoopData = session('errors'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger text-center" role="alert">
            <strong><?php echo e($error); ?></strong>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<h3 class="card-title">Criar escala de <i><?php echo e($building->name); ?></i></h3>

<form action="<?php echo e(action('WorkSchedulesController@addFromBuilding', ['id' => $building->id])); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <div class="form-group row">
        <label for="workschedule-employee" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Empregado</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <select class="form-control" id="workschedule-employee" name="employee" required>
                <option value=""></option>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-lg-2 col-form-label">Horários</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
        <select class="form-control" id="workschedule-schedules" name="schedules[]" required>
                <option value=""></option>
                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($schedule->id); ?>"><?php echo e($schedule->time_range); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-lg-2 col-form-label">Dias escalados</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <select class="form-control" id="workschedule-dates" name="dates[]" data-role="tagsinput" multiple required>
               
            </select>

            <div id="datepicker" style="margin-top: 10px"></div>
        </div>
    </div>

    <a class="btn btn-danger" role="button" href="<?php echo e(action('BuildingsController@view', ['id' => $building->id])); ?>">Cancelar</a>
    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('css/jquery-ui.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/jquery-ui.theme.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/tagsinput.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/tagsinput.js')); ?>"></script>

<script>
$('#datepicker').datepicker({
   dateFormat: 'dd/mm/yy',
   dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
   dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
   dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
   monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
   monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
   nextText: 'Proximo',
   prevText: 'Anterior',

    onSelect: function(dateText, inst) {
        $('#workschedule-dates').tagsinput('add', dateText);
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>