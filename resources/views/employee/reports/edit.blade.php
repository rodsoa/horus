@extends('layouts.base')

@section('content')
<h3 class="card-title">Editar relatório de ocorrência <i>{{ $report->title }} </i- <i>{{ $report->building->name }}</i></h3>

<form id="needs-validation" action="{{ action('Employee\ReportsController@update', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <input type="hidden" name="work_schedule_id" value="{{ $report->work_schedule->id }}" >
    <input type="hidden" name="employee_id" value="{{ $report->work_schedule->employee->id }}" >
    <input type="hidden" name="building_id" value="{{ $report->work_schedule->building->id }}">
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-5 col-lg-5">
            <label for="title-report">Título do relatório</label>
            <input type="text" class="form-control" id="title-report" name="title" placeholder="Digite um título para o relatório" value="{{ $report->title }}">
            <div class="invalid-feedback">
                Por favor informe um título para o relatório.
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="report-description">Descrição</label>
            <textarea class="form-control" id="report-description" name="description" placeholder="Detalhe a ocorrência no relatório">{{ $report->description }}</textarea>
            <div class="invalid-feedback">
                Por favor detalhe a ocorrência.
            </div>
        </div>
    </div>

    <a class="btn btn-danger" role="button" href="{{ action('Employee\ReportsController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>
@endsection

@section('js')
<script src="/js/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
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
          html += '<input type="file" id="photo" class="custom-file-input form-control" name="photos[]" required><span id="photo-location" class="custom-file-control"></span></label>';
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