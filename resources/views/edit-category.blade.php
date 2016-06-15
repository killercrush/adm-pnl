@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ url('/product') }}">Товар</a> &gt; Добавить категорию</div>

                <div class="panel-body">
                    <form class="form-inline" role="form" method="POST" action="{{ url('/product/addCategory') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label">Название</label>
                                <input id="name" type="text" class="form-control" name="name" value="">
                            </div>                               
                        </div>
                     
                        <div class="col-md-12">
                            <hr>
                            <div class="col-md-2 col-md-offset-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i> Сохранить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
