@extends('app')

@section('header')

    <span>Новый курс</span>

    <a href="{{ route('courses') }}">Курсы</a>

    <a href="{{ action('AdvancedReg@logout') }}">
        @if ( Auth::check() )
            {{ $usaName }}
        @endif
    </a>

@stop

@section('newcourse')

    <div class="topBlueLine">
        Заполните форму ниже для добавления нового курса
    </div>

    <div class="backDiv">
        <form action="{{ action('HomeController@addCourse') }}" method="post" class="nCourse">
        <div class="nCourseLogo">
            <div class="onliOneCourse">
                <div class="plate">
                    <div class="bottom"></div>
                </div>
            </div>

    {{----------------------------------------------------------------------------}}
            <div id="add_logo">
                <input name="logofile" type="file" accept="image/*">
                <button class="flatGreenButton" type="submit">Добавить изображение курса</button>
            </div>

        </div>

        @if(Session::has('message'))

            <div class="alertMessaga">
                {!!Session::get('message')!!}
            </div>
        @endif

        <div class="nCourseContent">
            <div class="newcoursecontent">
                <div>
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

                    <button type="submit" class="greenButton">Добавить курс</button>
                </div>
            </div>
        </div>
    </form>
    </div>
@stop
