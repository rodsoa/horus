<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>RELATORIO DE OCORRÊNCIA</title>
    </head>
    <body>
        <center>
            <h2>RELATORIO DE OCORRÊNCIA</h2>
            <h6 style="padding-top: -25px;">Criado: {{ $report->created_at->format('d-m-y H:i') }} | Atualizado: {{ $report->updated_at->format('d-m-y H:i') }}</h6>
        </center>

        <hr />
        <style>
            ul { 
                display: block;
                list-style-type: none;
                margin-top: 1em;
                margin-bottom: 1 em;
                margin-left: 0;
                margin-right: 0;
                padding-left: 0;
            }

            .img-portrait {
                list-style-type: none;
                margin-top: 1em;
                margin-bottom: 1 em;
                margin-left: 0;
                margin-right: 0;
                padding-left: 0;
            }

            .img-portrait li {
                display: inline;
                margin-right: 10px;
            }
        </style>
        <ul>
            <li><b>Coordenador:</b> {{ $report->user->name }}</li> 
        </ul>

        <ul>
            <li><b>Agente escalado:</b> {{ $report->employee->name }} - {{ $report->employee->registration_number }} </li>
            <li><b>Tel. Fixo:</b> {{ $report->employee->phone }} </li>
            <li><b>Tel. celular:</b> {{ $report->employee->cell_phone }} </li>
            <li><b>Email:</b> {{ $report->employee->email }} </li>
        </ul>

        <ul>
            <li><b>Unidade:</b> {{ $report->building->name }} </li>
            <li><b>Endereço:</b> {{ $report->building->address }} </li>
            <li><b>Descrição:</b> {{ $report->building->description }} </li>
        </ul>

        <hr />

        <p>
            <center>
                <h2>Ocorrência</h2>
                <h6 style="padding-top: -25px;">Data da ocorrência: {{ (\DateTime::createFromFormat('Y-m-d', $report->occurrence_date))->format('d-m-Y') }}</h6>
            </center>
            {!! $report->description !!}
            <p>
                <br />
                <ul class="img-portrait" style="margin-top: 10px;">
                    @foreach($report->report_images as $img)
                        <li><img src="{{ base_path() }}/public/upload/{{ $img->path }}" width="160px;"></li>
                    @endforeach
                <ul>
            </p>
            <hr />
        </p>

        <footer>
            <center>
               <p>
                     _________________________________________
                    <br />
                    <span>Autor</span>
                    <br  />
                    _________________________________________
                    <br />
                    <span>Diretor</span>
                    <br  />
                    _________________________________________
                    <br />
                    <span>Coordenador</span>
                    <br />
               </p>

                <p>
                   <span>Data de impressão: <i>{{ (new \DateTime('NOW'))->format('d-m-y H:i') }}</i> </span>
                   <br/>
                   <span>Sistema HORUS - SAMHOST</i> </span>
                </p>
            </center>
            <p>
            </p>
        </footer>
    </body>
</html>