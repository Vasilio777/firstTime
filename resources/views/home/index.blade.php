@extends('app')

@section('index')

    <header class="header">
        <div>Интерактивный образовательный портал</div>
    </header>
    <div id="wrapper">

        <div class="indexRegist">
            <div class="heading">
                <form action="{{ action('AdvancedReg@postLogin') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <ul class="input-group form-control">
                    <li>
                        <input type="text" name="name" placeholder="Имя пользователя" required>
                    </li>

                    <li>
                        <input type="password" name="password" placeholder="Пароль" required>
                    </li>
                </ul>
                    <button type="submit" class="enterButton">Вход</button>
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

@stop

