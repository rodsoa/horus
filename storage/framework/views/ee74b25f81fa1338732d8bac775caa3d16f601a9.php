<?php $__env->startSection('content'); ?>
<h3 class="card-title">Exibir informações de <?php echo e($building->name); ?></h3>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-responsive">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="2">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Status:</th>
                            <td class="text-right">
                                <?php if( $building->status ): ?>
                                    <i class="fa fa-check-circle-o" style="color: green;"></i> Ativo
                                <?php endif; ?>

                                <?php if( !$building->status ): ?>
                                    <i class="fa fa-times-circle" style="color: red;"></i> Inativo
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Nome:</th>
                            <td class="text-right"><?php echo e($building->name); ?></td>
                        </tr>
                        <tr>
                            <th>Endereço:</th>
                            <td class="text-right"><?php echo e($building->address); ?></td>
                        </tr>
                        <tr>
                            <th>Descrição:</th>
                            <td class="text-right"><?php echo e($building->description); ?></td>
                        </tr>
                    </tbody>
                </table>

                <?php if( Auth::user()->category !== "P"): ?>
                    <a role="button" class="btn btn-block btn-info" href="<?php echo e(action('BuildingsController@edit', ['id' => $building->id ])); ?>">Atualizar Unidade</a>
                <?php endif; ?>
                <a role="button" class="btn btn-block btn-secondary" href="<?php echo e(action('BuildingsController@index')); ?>">Retornar</a>
            </div>
        </div>
        <br />
    </div>

    <div class="col-sm-12 col-md-8 col-lg-8">
        <?php if( Auth::user()->category === "P"): ?>
            <a role="button" class="btn btn-block btn-primary" href="<?php echo e(action('ReportsController@new')); ?>">
                    <i class="fa fa-file fa-fw">&nbsp;</i>Criar relatório de ocorrência
            </a>
        <?php endif; ?>

        <?php if( Auth::user()->category !== "P"): ?>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="outro group">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-download"></i>download
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '01'])); ?>"></i>JANEIRO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '02'])); ?>">FEVEREIRO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '03'])); ?>"></i>MARÇO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '04'])); ?>">ABRIL</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '05'])); ?>"></i>MAIO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '06'])); ?>">JUNHO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '07'])); ?>">JULHO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '08'])); ?>"></i>AGOSTO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '09'])); ?>">SETEMBRO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '10'])); ?>"></i>OUTUBRO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '11'])); ?>">NOVEMBRO</a>
                                <a class="dropdown-item" href="<?php echo e(action('BuildingsController@generatePDF', ['id' => $building->id, 'month' => '12'])); ?>"></i>DEZEMBRO</a>
                            </div>
                        </div>
                </div>
                <div class="btn-group mr-2" role="group" aria-label="Second group">
                    <?php if( count($building->work_schedules) ): ?>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-table fa-fw"></i>Gerenciar escalas
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?php echo e(action('WorkSchedulesController@editFromBuilding', ['id' => $building->id])); ?>"><i class="fa fa-pencil fa-fw"></i>editar escala</a>
                                <a class="dropdown-item" href="<?php echo e(action('WorkSchedulesController@newFromBuilding', ['id' => $building->id])); ?>"><i class="fa fa-plus fa-fw"></i>adicionar escala</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a role="button" class="btn btn-secondary" href="<?php echo e(action('WorkSchedulesController@newFromBuilding', ['id' => $building->id])); ?>">
                            <i class="fa fa-table fa-fw">&nbsp;</i>escala
                        </a>
                    <?php endif; ?>
                </div>

                <div class="btn-group" role="group" aria-label="Third group">
                    <?php if($building->status): ?>
                        <a role="button" class="btn btn-danger" href="<?php echo e(action('BuildingsController@toggleStatus', ['id' => $building->id])); ?>">Inativar</a>
                    <?php else: ?>
                        <a role="button" class="btn btn-success" href="<?php echo e(action('BuildingsController@toggleStatus', ['id' => $building->id])); ?>">Ativar</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <table class="table table-sm table-hover" style="margin-top: 15px;">
            <thead class="bg-custom-primary">
                <tr class="text-center">
                    <th colspan="2">Agenda Eletrônica</th>
                </tr>
            </thead>
        </table>
        <div id="building-calendar" style="margin-bottom: 20px;"></div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <table class="table table-condensed table-bordered table-hover table-responsive">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="5">Ultimos relatórios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                     <?php echo e($report->title); ?>

                                </td>
                                <td><i>coordenador</i>: <?php echo e($report->user->name); ?></td>
                                <td><i>agente</i>: <?php echo e($report->employee->name); ?></td>
                                <td class="text-center"><?php echo e((\DateTime::createFromFormat('Y-m-d', $report->occurrence_date))->format('d-m-Y')); ?></td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a role="button" class="btn btn-secondary" href="<?php echo e(action('ReportsController@view', ['id' => $report->id])); ?>"><i class="fa fa-eye"></i></a>
                                        <a role="button" class="btn btn-warning" href="<?php echo e(action('ReportsController@generatePDF', ['id' => $report->id])); ?>"><i class="fa fa-file-pdf-o"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <br />
            </div>
        </div>
    </div>
</div>

<br />

<!-- Modal -->
<div class="modal fade" id="calendar-modal" tabindex="-1" role="dialog" aria-labelledby="calendar-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calendar-modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="calendar-modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $('#building-calendar').fullCalendar({
        locale: 'pt-br',
        events: '/api/buildings/<?php echo e($building->id); ?>/get-all-workschedules',
        eventClick: function(calEvent, jsEvent, view) {
            var html = "<h5>"+ calEvent.title +"</h5>";
            html +=  '<b>Horário:</b> '+ $.fullCalendar.formatDate(calEvent.start, "HH:mm");
            //html +=  ' - ' + $.fullCalendar.formatDate(calEvent.end, "HH:mm");
            console.log(calEvent.end);
            $("#calendar-modal-title").html("");
            $("#calendar-modal-body").html(html);
            $('#calendar-modal').modal('show');

        },
        dayClick: function(date, allDay, jsEvent, view) { 
            var dayDate = $.fullCalendar.formatDate( date, "Y-MM-DD");
            
            var html = "Escalas para " + $.fullCalendar.formatDate( date, "DD-MM-Y");

            $("#calendar-modal-title").html(html);

            axios.get('/api/buildings/<?php echo e($building->id); ?>/'+dayDate+'/get-all-workschedules')
                 .then(function (data) {
                     var html = "";
                     events = data.data
                    console.log(events.length)
                    for (var cont = 0; cont < events.length; cont++) {
                        html += "<b>"+events[cont].title+":</b> "+events[cont].start +"<br/>";
                    }
                    $("#calendar-modal-body").html(html);
                 })
                 .catch();
            $('#calendar-modal').modal('show');
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>