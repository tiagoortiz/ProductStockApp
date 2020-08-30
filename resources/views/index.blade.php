@extends('app')
 
@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Produtos</h1>
    <div>
    <a href="create" class="btn btn-primary mb-3">Adicionar produto</a>
    </div>     
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nome</td>
          <td>SKU</td>
          <td>Modificado em</td>
          <td colspan = 2>Ações</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }} </td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->updated_at }}</td>
            <td>
                <a href="edit/{{ $product->id }}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="delete/{{ $product->id }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection