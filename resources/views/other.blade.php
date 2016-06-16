@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Другое</div>
                <div class="panel-body">
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
                    @if ( Session::has('message') )
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ Session::get('message') }}       
                        </div>
                    @endif
                    <div class="col-md-7">
                         <div class="panel panel-default">
                            <div class="panel-heading">Реферальная система</div>
                            <div class="panel-body">
                            <form role="form" method="POST" action="{{ url('/other/save-ref') }}" class="form-inline">
                                {{ csrf_field() }}
                                <label for="">Реферальный процент:</label>
                                <input required class="form-control form-control-small" type="number" name="ref_value" value="{{ $ref_value }}">
                                <span>%</span>
                                <input type="submit" class="btn btn-success" value="Сохранить">
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                         <div class="panel panel-default">
                            <div class="panel-heading">Очистка БД</div>
                            <div class="panel-body">
                            <form role="form" method="POST" action="{{ url('/other/clear-db') }}" class="form-inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <label for="">Cтарше:</label>
                                <input required class="form-control form-control-small" type="number" name="days_count" value="1">
                                <span>дней</span>
                                <input type="submit" class="btn btn-danger" value="Очистить БД">
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                         <div class="panel panel-default">
                            <div class="panel-heading">Обратная связь</div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Тема обращения</th>
                                            <th>Ник</th>
                                            <th>Текст обращения</th>
                                            <th>Функции</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($feedbacks as $feedback)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $feedback->theme }}</td>
                                                <td>{{ $feedback->user->login }}</td>
                                                <td>
                                                    <textarea class="textarea-fixed" name="" id="" cols="30" rows="6" readonly>
                                                        {{ $feedback->user_text }}
                                                    </textarea>
                                                    
                                                </td>
                                                <td>
                                                    <a class="btn btn-default" href="{{ url('/other/feedback-close') }}">Закрыть</a>
                                                    <a class="btn btn-default" href="#response_form" onclick="show_modal({{ $feedback->id }}); return false;">Ответить</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Modal-->
                                <div id="response_form" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Ответ для пользователя</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form id="response_form" role="form" method="POST" action="{{ url('/other/feedback-edit') }}" class="form-inline">
                                        
                                            {{ csrf_field() }}
                                            <input type="hidden" id="feedback_id" name="feedback_id" value="0">
                                            <textarea class="textarea-modal" name="response_text" id="" cols="40" rows="10"></textarea>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success" value="Отправить">
                                            </div>
                                        </form>
                                      </div>                                      
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection