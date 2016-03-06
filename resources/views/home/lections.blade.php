@extends('app')

@section('lections')

    <header class="header">
        <div>
            Меню выбора лекций
        </div>
    </header>

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
                    <img src="{{ URL::asset('images/icon/AddCompomemt.png') }}" alt="Изображение недоступно">
                </a>
            </div>
        </div>

        <div class="newcoursecontent">
            @foreach($lections as $lection)
                @if( $lection->idcourse == $chosencourse->id)
                    <a href="/lections/{{ $lection->id }}">{{ $lection->ltitle }}</a>
                    <div>
                        {{ $lection->ldesc }}
                    </div>
                @endif
            @endforeach

        @if ($usachek == 1)
                <ul id="otherContent" class="accordion">
                    <!--        ВИДЕО  ------------------------------------------------>
                    <li>
                        <div class="link">Видеоматериалы</div>

                        <ul class="submenu">

                            @if ($usachek == 1)
                                <li>
                                    <div class="mainOtherContent">

                                        <form id="add_video" action="{{ action('HomeController@addVideo') }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input {{--}}multiple="multiple"--}} name="videofile{{--[]--}}" type="file">
                                            <button class="button" type="submit">Добавить новое видео</button>
                                        </form>
                                    </div>
                                </li>
                            @endif

                        </ul>
                    </li>

                    <!--          МЕТОДИЧКА --------------------------------------->
                    <li>
                        <div class="link">Методические указания</div>

                        <ul class="submenu">

                            @if ($usachek == 1)
                                <li>
                                    <div class="mainOtherContent">

                                        <form id="add_method" action="{{ action('HomeController@addTableRecord') }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input {{--}}multiple="multiple"--}} name="userfile{{--[]--}}" type="file">
                                            <button class="button" type="submit">Добавить новый документ</button>
                                        </form>
                                    </div>
                                </li>
                            @endif

                        </ul>
                    </li>

                </ul>

                <form class="changeForm" action="{{ action('HomeController@addLection') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <ul class="input-group form-control">
                        <li>
                            <input type="text"  name="ltitle" placeholder="Введите название новой лекции" required>
                        </li>

                        <li>
                            <textarea rows="5" name="ldesc" placeholder="Введите описание для новой лекции" required></textarea>
                        </li>
                    </ul>
                    <button type="submit" class="newcourseButtons">Добавить лекцию</button>
                </form>
            </div>
        @endif
    </div>

@stop


