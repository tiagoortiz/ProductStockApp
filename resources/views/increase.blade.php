@extends('app') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Adicionar estoque ao produto</h1>
        <h3>{{ $product->name }}</h3>
 
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="/updateIncrease/{{ $product->id }}">
            @csrf
          <div class="form-group">
              <label for="quantity_available">Quantidade:</label>
              <input type="text" class="form-control" name="quantity_available" placeholder="Informe a quantidade para ser dado baixa"/>
          </div>
          <button type="submit" class="btn btn-primary">Adicionar</button>
          <a href="/" class="btn btn-warning">Cancelar</a>
        </form>
    </div>
</div>
@endsection