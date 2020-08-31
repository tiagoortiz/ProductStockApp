@extends('layouts.app')
 
@section('content')
<div class="row">
<div class="col-sm-12">
    <div>
    <a href="create" class="btn btn-primary mb-3">Adicionar produto</a>    
    <a href="transactions" class="btn btn-secondary mb-3">Relatório</a>
    </div>     
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
    @endif
    @if (session()->get('alert'))
      <div class="alert alert-danger">
        {{ session()->get('alert') }}  
      </div>
      <br /> 
    @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td></td>
          <td>ID</td>
          <td>Nome</td>
          <td>SKU</td>
          <td>Quantidade</td>
          <td>Ações</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
          <td>
            <form action="delete/{{ $product->id }}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit">Remover</button>
            </form>
          </td>
          <td>{{ $product->id }}</td>
          <td>{{ $product->name }} </td>
          <td>{{ $product->sku }}</td>
          <td>{{ $product->quantity_available }}</td>
          <td>
            <a href="increase/{{ $product->id }}" class="btn btn-primary">Adicionar</a>
            <a href="decrease/{{ $product->id }}" class="btn btn-warning">Baixa</a>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection