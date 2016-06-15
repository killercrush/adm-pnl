@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 payment-page">
            <div class="panel panel-default">
                <div class="panel-heading">Товар</div>
                <div class="panel-body">
                    @foreach($payments as $payment)
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>{{ $payment->name }}</b></div>
                                <div class="panel-body">
                                    <form class="" role="form" method="POST" action="{{ url('/payment') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="site_name" class="control-label">{{ $payment->identity_name}}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input required class="form-control"  type="text" name="identity_string" value="{{ $payment->identity_string }}">
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-4">
                                                <label for="site_name" class="control-label">Пароль</label>
                                            </div>    
                                            <div class="col-md-8">
                                                <input required class="form-control"  type="password" name="password" value="{{ $payment->password }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary" value="Сохранить">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection