@extends('app')

@section('courses')


    <header class="header">
        <span>Добро пожаловать в интерактивный образовательный портал!</span>
        <span>Для начала работы выберите необходимый курс для изучения</span>
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

    <div class="courses">
        <div class="wrapper">
            @foreach($courses as $course)
                <div class="course">
                    <a class="plate"  href="/course{{ $course->id }}/lections">
                        <img src="{{ URL::asset('images/icon/'.$course->image) }}" alt="Пожалуйста, добавьте изображение">
                        <div data-title="{{ $course->cdesc }}" class="bottom"></div>
                    </a>
                </div>
            @endforeach
            @if ($usachek == 1)
                <div class="course">
                    <a class="plate" href="{{ action('HomeController@newcourse') }}">
                        <img src="{{ URL::asset('images/icon/AddCompomemt.png') }}" alt="Изображение отсутствует">
                        <div class="bottom"></div>
                    </a>
                </div>
            @endif
        </div>
    </div>
@stop