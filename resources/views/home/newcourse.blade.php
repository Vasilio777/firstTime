@extends('app')

@section('newcourse')


    <header class="miniHeader">
        <span>Интерактивный образовательный портал</span>
    </header>

    <div class="header">
        <span>Страница добавления нового курса в систему интерактивного обучения</span>
        <span>Заполните все поля, добавив необходимую информацию</span>
    </div>

    <nav>
        <ul>
            <li>
                <a href="{{ route('courses') }}">Курсы</a>
            </li>

            <li>
                @if ( Auth::check() )
                    {{ $usaName }}
                @endif
                <a href="{{ action('AdvancedReg@logout') }}">(Выход)</a>
            </li>
        </ul>
    </nav>

    <div class="nCourse">
        <div class="nCourseLogo">
            <div class="onliOneCourse">
                <a class="plate" href="{{ action('HomeController@addLogo') }}">
                    <img src="{{ URL::asset('images/icon/Fade.png') }}" alt="Изображение не доступно">
                    <div class="bottom"></div>
                </a>
            </div>

    {{----------------------------------------------------------------------------}}
            <form id="add_logo" {{--action="{{ action('HomeController@saveLogo') }}" method="post"--}} enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="logofile" type="file">
                <button class="newcourseButton add_button" type="submit">Добавить изображение курса</button>
            </form>
        </div>

        @if(Session::has('message'))

            <div class="alertMessaga">
                {!!Session::get('message')!!}
            </div>
        @endif

        <div class="nCourseContent">
            <div class="newcoursecontent">
                <form class="changeForm" action="{{ action('HomeController@addCourse') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <ul class="input-group form-control">
                        <li>
                            <input type="text"  name="coursetitle" placeholder="Название курса" required>
                        </li>

                        <li>
                            <textarea rows="5" name="cdesc" placeholder="Описание курса" required></textarea>
                        </li>

                        <li>
                            <textarea rows="5" name="requirements" placeholder="Требования к слушателю" required></textarea>
                        </li>

                        <li>
                            <textarea rows="5" name="forWhom" placeholder="Для кого предназначен курс" required></textarea>
                        </li>
                    </ul>
                    <button type="submit" class="newcourseButtons">Добавить курс</button>
                </form>
            </div>
        </div>
    </div>
@stop
