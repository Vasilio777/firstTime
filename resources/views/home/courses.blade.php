@extends('app')

@section('header')

    <span>Каталог видеокурсов</span>

    <a href="{{ action('AdvancedReg@logout') }}">
        @if ( Auth::check() )
            {{ $usaName }}
        @endif
    </a>
@stop

@section('courses')

    <div class="topBlueLine">
        Для начала работы выберите необходимый курс для изучения
    </div>
    <div class="backDiv">
        <div class="wrapper">
            @foreach($courses as $course)
                @if ($course->cdesc != 'скоро')
                    <div class="course">
                        <a class="plate"  href="/course{{ $course->id }}/lections">
                            <img src="{{ URL::asset('images/icon/'.$course->image) }}" alt="Пожалуйста, добавьте изображение">
                            <div data-title="{{ $course->cdesc }}" class="bottom"></div>
                        </a>
                    </div>
                @endif
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