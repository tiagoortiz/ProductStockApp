@extends('layouts.app')
 
@section('content')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Relatório</h1>
    <a href="/" class="btn btn-primary">Voltar para home</a>
    <h2>Movimentação do dia</h2>
    <table class="table table-striped">
        <thead>
            <tr>
            <td>Nome</td>
            <td>SKU</td>
            <td>Quantidade</td>
            <td>Modo</td>
            </tr>
        </thead>
        <tbody>
            @foreach($data['transactions'] as $transaction)
            <tr>
                <td>{{ $transaction->name }} </td>
                <td>{{ $transaction->sku }}</td>
                <td>{{ $transaction->quantity }}</td>
                <td>{{ $transaction->type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Produtos com baixo estoque</h2>
    <table class="table table-striped">
        <thead>
            <tr>
            <td>Nome</td>
            <td>SKU</td>
            <td>Quantidade</td>
            </tr>
        </thead>
        <tbody>
            @foreach($data['lowStockProducts'] as $product)
            <tr>
                <td>{{ $product->name }} </td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->quantity_available }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div>
</div>
@endsection