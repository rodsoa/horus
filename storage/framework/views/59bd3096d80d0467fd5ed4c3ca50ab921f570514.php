<?php $__env->startSection('content'); ?>
<h3 class="card-title">Editar escalas de <i><?php echo e($employee->name); ?></i></h3>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card card-body bg-custom-primary" style="border-bottom-left-radius:0px; border-bottom-right-radius: 0px;">    
            <nav class="nav nav-pills nav-fill" id="myTab" role="tablist">     
                <?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="nav-item nav-link" id="nav-<?php echo e($value); ?>-tab" data-toggle="pill" href="#nav-<?php echo e($value); ?>" role="tab" aria-controls="nav-<?php echo e($value); ?>" aria-expanded="true"><?php echo e($day); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
        </div>

        <div class="tab-content" id="nav-tabContent">         
            <?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade" id="nav-<?php echo e($value); ?>" role="tabpanel" aria-labelledby="nav-<?php echo e($value); ?>-tab">
                <div class="card custom card-body">     
                    <form action="<?php echo e(action('WorkSchedulesController@updateFromEmployee', ['id' => $employee->id])); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="employee_id" value="<?php echo e($employee->id); ?>" >
                        <?php $__currentLoopData = $employee->work_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workschedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($workschedule->weekday == $value): ?>
                                <input type="hidden" name="work_schedules_id[]" value="<?php echo e($workschedule->id); ?>" >
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <select class="form-control" id="workschedule-building" name="buildings_id[]" required>
                                                <option value=""></option>
                                                <?php $__currentLoopData = $buildings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $building): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($building->id); ?>" <?php if($workschedule->building_id == $building->id): ?> selected <?php endif; ?>><?php echo e($building->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <select class="form-control" id="workschedule-schedule" name="schedules_id[]" required>
                                                <option value=""></option>
                                                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($schedule->id); ?>" <?php if($workschedule->schedule_id == $schedule->id): ?> selected <?php endif; ?>><?php echo e($schedule->time_range); ?> <?php echo e((\DateTime::createFromFormat('Y-m-d', $workschedule->date))->format('d-m-Y')); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <button id="delete-<?php echo e($workschedule->id); ?>" type="button" class="btn bt-sm btn-block btn-danger" onclick="deleteWorkSchedule(<?php echo e($workschedule->id); ?>)">
                                            <i class="fa fa-trash"></i> Excluir
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <br />
                        <a role="button" class="btn btn-danger" href="<?php echo e(action('EmployeesController@view', ['registration_number' => $employee->registration_number])); ?>">Cancelar</a>
                        <button type="submit" class="btn btn-success">Editar escalas</button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<form id="delete-form" method="POST">
    <?php echo e(csrf_field()); ?>

    <?php echo e(method_field('DELETE')); ?>

    <input type="hidden" name="employee_id" value="<?php echo e($employee->id); ?>">
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    function deleteWorkSchedule ( id ) {
        if( confirm("Tem certeza em realizar essa ação ?") ) {
            // TODO: Fazer callback mais atraente para essa requisição
            var url = '/escalas' + '/' + id + '/deletar';
            $('#delete-form').attr('action', url);
            $('#delete-form').submit();
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>