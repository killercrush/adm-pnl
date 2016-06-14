@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Общие</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/common') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="site_name" class="col-md-4 control-label">Название сайта</label>
                            <div class="col-md-6">
                                <input id="site_name" type="text" class="form-control" name="site_name" value="{{ $common->site_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="col-md-4 control-label">Ключевые слова (через запятую)</label>
                            <div class="col-md-6">
                                <textarea id="keywords" class="form-control" name="keywords">{{ $common->keywords }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="site_desc" class="col-md-4 control-label">Описание сайта</label>
                            <div class="col-md-6">
                                <textarea id="site_desc" class="form-control" name="site_desc">{{ $common->site_desc }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="site_down_desc" class="col-md-4 control-label">Текст, выводящийся при выключенном сайте</label>
                            <div class="col-md-6">
                                <textarea id="site_down_desc" class="form-control" name="site_down_desc">{{ $common->site_down_desc }}</textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="checkbox col-md-6 col-md-offset-4"> 
                                <label> <input id="is_site_down" type="checkbox" name="is_site_down" value="1" {{ $common->is_site_down == 1 ? 'checked' : '' }}>Выключить сайт</label> 
                            </div>
<!--                             <div class="col-md-4"></div>
                            <div class="col-md-6 checkbox">
                                <input id="is_site_down" type="checkbox" class="" name="is_site_down" {{ $common->is_site_down == 1 ? 'checked' : '' }}>
                                <label for="is_site_down" class="control-label">Выключить сайт</label>
                            </div> -->
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
