@extends('layouts.base')

@section('content')
<h3 class="card-title">Editar relatório de ocorrência <i>{{ $report->title }} </i- <i>{{ $report->building->name }}</i></h3>

<form id="needs-validation" action="{{ action('ReportsController@update', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
{{ csrf_field() }}
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

<div class="form-row">
    <div class="form-group col-sm-12 col-md-4 col-lg-3">
        <label for="report-date">Data da Ocorrência</label>
        <input type="text" class="form-control" id="report-date" name="occurrence_date" value="{{ (DateTime::createFromFormat('Y-m-d', $report->occurrence_date))->format('d/m/Y')}}">   
        <div class="invalid-feedback">
            Por favor insira a data da ocorrência.
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="report-building">Unidade</label>
        <select class="form-control" id="report-building" name="building_id">
        <option> </option>
            @foreach($buildings as $building)
                <option value="{{ $building->id }}" @if($building->id == $report->building->id) selected @endif>{{ $building->name }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Por favor escolha a unidade.
        </div>
    </div>

    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="report-employees">Agente</label>
        <select class="form-control" id="report-employees" name="employee_id">        
        <option value="{{ $report->employee->id }}" selected>{{ $report->employee->name }}</option> 
        </select>
        <div class="invalid-feedback">
            Por favor escolha o agente.
        </div>
    </div>

    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="reports-employee-schedules">Horário</label>
        <select class="form-control" id="report-employee-schedules" name="schedule_id">            
            <option value=""></option>
            @foreach ( $schedules as $schedule )
                <option value="{{ $schedule->id }}" @if($schedule->id == $report->schedule->id) selected @endif>{{ $schedule->time_range }}</option>
            @endforeach              
        </select>
        <div class="invalid-feedback">
            Por favor escolha o horário.
        </div>
    </div>
</div>

<hr />

<div class="form-row">
    <div class="form-group col-sm-12 col-md-6 col-lg-6">
        <label for="title-report">Título do relatório</label>
        <input type="text" class="form-control" id="title-report" name="title" value="{{ $report->title }}" placeholder="Digite um título para o relatório">
        <div class="invalid-feedback">
            Por favor informe um título para o relatório.
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-12 col-lg-12">
        <label for="report-description">Descrição</label>
        <textarea class="form-control" id="report-description" name="description" placeholder="Detalhe a ocorrência no relatório">{!! $report->description !!}</textarea>
        <div class="invalid-feedback">
            Por favor detalhe a ocorrência.
        </div>
    </div>
</div>

<!--div class="input_fields_wrap">
    <button class="btn btn-primary btn-sm add_field_button" style="margin-bottom: 12px;"><i class="fa fa-plus fa-fw"></i>Adicionar imagem</button>

    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label class="custom-file">
            <input type="file" id="photos" class="custom-file-input form-control" name="photos[]">
            <span id="photo-location" class="custom-file-control"></span>
        </label>
        <div class="invalid-feedback">
            Por favor, escolha uma imagem.
        </div>
    </div>
</div-->

<a class="btn btn-danger" role="button" href="{{ action('ReportsController@index') }}">Cancelar</a>
<button type="submit" class="btn btn-success">Cadastrar</button>
</form>
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="/js/jquery.mask.min.js"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="//cdn.ckeditor.com/4.7.2/basic/ckeditor.js"></script>
<script>
    $(document).ready(function() {
    CKEDITOR.replace('report-description');
    $('#report-date').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Proximo',
        prevText: 'Anterior',
    });

    // Obtendo dados para popular campos
    $("#report-building").change( function () {
        var e = document.getElementById("report-building");
        var id = e.options[e.selectedIndex].value;
        var url = '/api/buildings/'+ id +'/get-all-employees'
        axios.get(url)
            .then(function ( data ) {
                var employees = data.data;
                var html = "";
                for(var cont = 0; cont < employees.length; cont++) {
                    html += "<option value='"+employees[cont].id+"'>"+employees[cont].name+"</option>";
                }
                $("#report-employees").html(html);
            })
            .catch()
    });



    var max_fields = 5; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        var length = wrapper.find("input:text").length;

        if (x < max_fields) { //max input box allowed
            x++; //text box increment

            var html  = '<div class="form-group col-sm-12 col-md-4 col-lg-4"><label class="custom-file">';
                html += '<input type="file" id="photo" class="custom-file-input form-control" name="photos[]"><span id="photo-location" class="custom-file-control"></span></label>';
                html += '<div class="invalid-feedback">Por favor, escolha uma imagem.</div></div>';
                
            $(wrapper).append(html); //add input box
        }

        //Fazendo com que cada uma escreva seu name
        wrapper.find("input:text").each(function() {
            $(this).val($(this).attr('name'))
        });
    });

    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

    });

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
@endsection