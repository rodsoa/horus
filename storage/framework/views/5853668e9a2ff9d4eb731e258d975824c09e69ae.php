<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>PREVISÃO DE ESCALA DE SERVIÇO</title>
    </head>
    <body>

        <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;margin:0px auto;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
        .tg .tg-baqh{text-align:center;vertical-align:top}
        </style>

        <center><img src="<?php echo e(base_path()); ?>/public/imgs/escala-logo.jpeg"></center>

        <br />
        <table class="tg" width="100%;">
            <thead>
                <tr>
                    <td class="tg-baqh" colspan="34">
                        <h3>PREVISÃO DE ESCALA DE SERVIÇO - MÊS REFERENTE: <?php echo e((new \DateTime('now'))->format('F/Y')); ?></h3>
                    </td>
                </tr>
                <tr>
                    <td class="tg-baqh" colspan="34">
                        <h3>
                            POSTO DE SERVIÇO: <?php echo e($building->name); ?> <br />
                            ENDEREÇO: <?php echo e($building->address); ?> <br />
                            LEGENDAS: <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($s->letter); ?>:<?php echo e($s->time_range); ?>&nbsp; <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </h3>
                    </td>
                </tr>
                <tr>
                    <th class="tg-baqh"><strong>AGENTES PATRIMONIAIS</strong></th>
                    <?php for($cont = 1; $cont <= 31; $cont++): ?>
                        <th class="tg-baqh" style="vertical-align:bottom"><strong><?php echo e($cont); ?></strong></th>
                    <?php endfor; ?>
                    <th class="tg-baqh"><strong>HORAS</strong></th>
                    <th class="tg-baqh"><strong>DIAS</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if( count($ws) ): ?>
                        <td class="tg-baqh"><?php echo e($emp->name); ?></td>
                        <?php for($cont = 0; $cont < 31; $cont++): ?>
                            <td class="tg-baqh">
                                <?php $__currentLoopData = $ws[$emp->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp_ws): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if( (\DateTime::createFromFormat('Y-m-d', $emp_ws->date))->format('d') == $cont+1): ?>
                                        <?php echo e($emp_ws->schedule->letter); ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        <?php endfor; ?>
                        <td class="tg-baqh"><?php echo e($total_hours[$key]); ?></td>
                        <td class="tg-baqh"><?php echo e(count($ws[$emp->id])); ?></td>
                    <?php else: ?>
                        <td class="tg-baqh" colspan=34> <center>SEM REGISTROS PARA O MÊS </center></td>
                        
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </body>
</html>