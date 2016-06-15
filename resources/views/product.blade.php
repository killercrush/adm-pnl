@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Товар</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Категория</th>
                                <th>Наименование</th>
                                <th>Количество</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->games->count() }}</td>
                                    <td><a class="btn btn-default" href="{{ url('/product/edit/') . '/' . $product->id}}">Редактировать</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="{{ url('/product/add') }}">Добавить товар</a>
                    <a class="btn btn-primary" href="{{ url('/product/addCategory') }}">Добавить категорию</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection