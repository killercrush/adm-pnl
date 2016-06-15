@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Мои данные
                @if ($errors->has())
                      @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ $error }}       
                        </div>
                        
                      @endforeach
                    @endif
                </div>

                <div class="panel-body">
                    <form role="form" method="POST" action="{{ url('/mydata') }}">
                        {{ csrf_field() }}

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{ $errors->has('email') ? old('email') : $user->email }}">
                            </div>                               
                        </div>
                        <hr>
                         <div class="col-md-12">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#changePassword" aria-expanded="false" aria-controls="collapseExample">
                              Сменить пароль
                            </button>
                            <hr>
                            <div class="collapse" id="changePassword">
                            <div class="panel panel-default">
                                <div class="panel-heading">Смена пароля</div>

                                <div class="panel-body">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">Пароль</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation" class="col-sm-2 control-label">Повторите пароль</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
