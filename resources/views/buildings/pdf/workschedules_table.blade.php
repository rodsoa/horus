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

        <center><img src="{{ base_path() }}/public/imgs/escala-logo.jpeg"></center>

        <br />
        <table class="tg" width="100%;">
            <thead>
                <tr>
                    <td class="tg-baqh" colspan="34">
                        <h3>PREVISÃO DE ESCALA DE SERVIÇO - MÊS REFERENTE: {{ (new \DateTime('now'))->format('F/Y')}}</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tg-baqh" colspan="34">
                        <h3>
                            POSTO DE SERVIÇO: {{ $building->name }} <br />
                            ENDEREÇO: {{ $building->address }} <br />
                            LEGENDAS: @foreach( $schedules as $s) {{ $s->letter}}:{{$s->time_range}}&nbsp; @endforeach
                        </h3>
                    </td>
                </tr>
                <tr>
                    <th class="tg-baqh"><strong>AGENTES PATRIMONIAIS</strong></th>
                    @for($cont = 1; $cont <= 31; $cont++)
                        <th class="tg-baqh" style="vertical-align:bottom"><strong>{{ $cont }}</strong></th>
                    @endfor
                    <th class="tg-baqh"><strong>HORAS</strong></th>
                    <th class="tg-baqh"><strong>DIAS</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $employees as $key => $emp )
                <tr>
                    <td class="tg-baqh">{{ $emp->name }}</td>
                    @for($cont = 0; $cont < 31; $cont++)
                        <td class="tg-baqh">
                            @foreach($ws[$emp->id] as $emp_ws)
                                @if( (\DateTime::createFromFormat('Y-m-d', $emp_ws->date))->format('d') == $cont+1)
                                    {{ $emp_ws->schedule->letter }}
                                @endif
                            @endforeach
                        </td>
                    @endfor
                    <td class="tg-baqh">{{ $total_hours[$key] }}</td>
                    <td class="tg-baqh">{{ count($ws[$emp->id]) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>