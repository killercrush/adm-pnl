@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Товар > {{ $is_adding ? 'Добавить' : 'Редактировать' }}</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/product') }}">
                        @if ( $is_adding )
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Наименование</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $is_adding ? '' : ''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-md-4 control-label">Категория</label>
                            <div class="col-md-6">
                                <input id="category_id" type="text" class="form-control" name="category_id" value="{{ $is_adding ? '' : ''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
