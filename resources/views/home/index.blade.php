@extends('app')

@section('header')

    <span>Вход</span>

@stop

@section('index')
<div class="indexDiv">
    <div id="wrapper">

        <div class="indexRegist">
            <div class="heading">
                <form action="{{ action('AdvancedReg@postLogin') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <ul class="input-group form-control">
                    <li id="login">
                        <input type="text" name="name" placeholder="Имя пользователя" required>
                    </li>

                    <li id="pass">
                        <input type="password" name="password" placeholder="Пароль" required>
                    </li>
                </ul>
                    <button type="submit" class="greenButton">Вход</button>
                </form>

                {{--<a href="{{  url('regist') }}">Вас нет в системе? Зарегистрируйтесь</a>--}}

            </div>
        </div>

        @if(Session::has('message'))

            <div class="alertMessaga">
                {!!Session::get('message')!!}
            </div>
        @endif
    </div>
</div>
@stop

