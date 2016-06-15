@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Товар</div>

                <div class="panel-body">
                    <div class="table table-with-forms">
                        <div class="form-row">
                            <div class="form-cell form-head">№</div>
                            <div class="form-cell form-head">Промокод</div>
                            <div class="form-cell form-head">Сумма</div>
                            <div class="form-cell form-head">Функции</div>
                        </div>

                        @foreach($promocodes as $promocode)
                            <?php ++$row_num; ?>
                            <form class="form-row" role="form" method="POST" action="{{ url('/promo') }}">
                                <div class="form-cell">
                                    <input type="hidden" name="promocode_id" value="{{ $promocode->id }}">
                                    {{ csrf_field() }}{{ $row_num }}
                                </div>
                                <div class="form-cell"><input required class="form-control" type="text" name="code" value="{{ $promocode->code }}"></div>
                                <div class="form-cell"><input required class="form-control input-sum" type="text" name="summ" value="{{ $promocode->summ }}">руб.</div>
                                <div class="form-cell">
                                    <input type="submit" class="btn btn-success" value="Сохранить">
                                    <form class="form-row" role="form" method="POST" action="{{ url('/promo') }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="promocode_id" value="{{ $promocode->id }}">
                                        <input type="submit" class="btn btn-danger" value="Удалить">
                                    </form>
                                </div>
                            </form>
                        @endforeach
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Генерировать промокод</b></div>
                        <div class="panel-body">
                            <form class="form-inline" role="form" method="POST" action="{{ url('/promo') }}">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <span>Сумма</span>
                                <input required class="form-control"  type="text" name="summ" value="">
                                <span> руб.</span>
                                <input type="submit" class="btn btn-primary" value="Генерировать">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection