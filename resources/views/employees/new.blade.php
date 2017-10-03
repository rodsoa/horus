@extends('layouts.base')

@section('content')
<h3 class="card-title">Cadastro de Empregado</h3>

<form id="needs-validation" action="{{ action('EmployeesController@add') }}" method="POST" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-2 col-lg-2">
            <label for="name">Matrícula</label>
            <input type="text" class="form-control" id="registration-number-employee" name="registration_number" placeholder="Digite a matrícula" required>
            <div class="invalid-feedback">
                Por favor informe a matrícula do empregado.
            </div>
        </div>

        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="name">Nome do empregado</label>
            <input type="text" class="form-control" id="name-employee" name="name" placeholder="Entre com o nome do empregado" required>
            <div class="invalid-feedback">
                Por favor informe nome do empregado.
            </div>
        </div>

        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="employee-category">Categoria</label>
            <select class="form-control" id="employee-category" name="employee_category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="photo">Foto <small><i>*jpg/jpeg</i></small></label>
            <label class="custom-file">
                <input type="file" id="photo" class="custom-file-input form-control" name="photo" required>
                <span id="photo-location" class="custom-file-control"></span>
            </label>
            <div class="invalid-feedback">
                Por favor, escolha uma imagem.
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="employee-address">Endereço</label>
            <input type="text" class="form-control" id="employee-address" name="address" placeholder="rua numero bairro" required>
            <div class="invalid-feedback">
                Por favor informe endereço do empregado.
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="employee-email">Endereço de email</label>
            <input type="email" class="form-control" id="employee-email" name="email" aria-describedby="employee-email-help" placeholder="empregado@email.com">
            <small id="employee-email-help" class="form-text text-muted">Nunca compartilhe essas informações com ninguém</small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="employee-phone">Telefone Residencial</label>
            <input type="text" class="form-control" id="employee-phone" name="phone" placeholder="(xx) xxxxx-xxxx" data-mask="(00) 00000-0000" required>
            <div class="invalid-feedback">
                Por favor informe número de telefone fixo do empregado.
            </div>
        </div>
    </div>

    <button class="btn btn-primary btn-sm add_field_button" style="margin-bottom: 12px;"><i class="fa fa-plus fa-fw"></i>Novo número</button>

    <div class="form-row input_fields_wrap">
        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label>Telefone Celular</label>
            <input type="text" class="form-control" id="employee-cellphone" name="cell_phones[]" placeholder="(xx) xxxxx-xxxx" data-mask="(00) 00000-0000" required>
            <div class="invalid-feedback">
                Por favor informe número de celular do empregado.
            </div>
        </div>
    </div>
    <a class="btn btn-danger" role="button" href="{{ action('EmployeesController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>
@endsection

@section('js')
<script>
  var max_fields = 4; //maximum input boxes allowed
  var wrapper = $(".input_fields_wrap"); //Fields wrapper
  var add_button = $(".add_field_button"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button).click(function(e) { //on add input button click
    e.preventDefault();
    var length = wrapper.find("input:text").length;

    if (x < max_fields) { //max input box allowed
      x++; //text box increment

      var html  = '<div class="form-group col-sm-12 col-md-3 col-lg-3"><label>Telefone celular '+x+'</label>';
          html += '<input type="text" class="form-control" id="employee-cellphone-'+x+'" name="cell_phones[]" placeholder="(xx) xxxxx-xxxx" data-mask="(00) 00000-0000" required>';
          html += '<div class="invalid-feedback">Por favor informe número de celular do empregado.</div></div>';
          
      $(wrapper).append(html); //add input box
    }
  });

  $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  })
</script>
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
<script src="/js/jquery.mask.min.js"></script>
@endsection