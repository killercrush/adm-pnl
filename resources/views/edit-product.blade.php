@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ url('/product') }}">Товар</a> &gt; {{ $is_adding ? 'Добавить' : 'Редактировать' }}</div>

                <div class="panel-body">
                    <form class="form-inline" role="form" method="POST" action="{{ url('/product') }}">
                        @if ( $is_adding )
                            {{ method_field('PUT') }}
                        @else
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @endif
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="control-label">Название</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $is_adding ? '' : $product->name }}">
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="control-label">Категория</label>
                            <select name="category_id" class="selectpicker">
                            @foreach($categories as $category)
                                @if ( !$is_adding && $product->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>
                                @else
                                    <option value="{{ $category->id }}">
                                @endif
                                {{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <?php $product_count = 1; ?>
                        <div class="games-container">
                            @if ( !$is_adding )
                                @foreach( $product->games as $game )                                
                                    <div id="game{{ $product_count }}">
                                        <hr>
                                        <input type="hidden" name="game_id[]" value="{{ $game->id }}">
                                        <div class="form-group form-group-key">
                                            <label>#<span class="num">{{ $product_count }}</span> Товар</label>
                                            <input type="text" class="form-control" name="key[]" value="{{ $game->key }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="">Кол-во билетов до начала игры</label>
                                            <input type="number" class="form-control tickets-count" name="tickets_count[]" value="{{ $game->tickets_count }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="">Цена</label>
                                            <input type="number" class="form-control price" name="price[]" value="{{ $game->price }}">
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="">Ссылка на картинку</label>
                                            <input type="text" class="form-control " name="image[]" value="{{ $game->image }}">
                                        </div>
                                    </div>
                                    <?php $product_count++; ?>
                                @endforeach
                            @endif
                            <div id="game{{ $product_count }}">
                                <hr>
                                <div class="form-group form-group-key">
                                    <label>#<span class="num">{{ $product_count }}</span> Товар</label>
                                    <input type="text" class="form-control" name="key[]" value="" onkeyup="addNewInp.bind(this)();">
                                </div>
                                <div class="form-group">
                                    <label class="">Кол-во билетов до начала игры</label>
                                    <input type="number" class="form-control tickets-count" name="tickets_count[]" value="5">
                                </div>
                                <div class="form-group">
                                    <label class="">Цена</label>
                                    <input type="number" class="form-control price" name="price[]" value="200">
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <label class="">Ссылка на картинку</label>
                                    <input type="text" class="form-control " name="image[]" value="">
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
