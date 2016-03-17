@extends('app')

@section('header')

    <span>{{ $chosencourse->coursetitle }}</span>

    <a href="{{ route('courses') }}">Курсы</a>

    <a href="{{ action('AdvancedReg@logout') }}">
        @if ( Auth::check() )
            {{ $usaName }}
        @endif
    </a>
@stop

@section('lections')

   <div class="topBlueLine">
        Ознакомьтесь с описанием курса и приступите к изучению материала
   </div>

    <div class="backDiv">
        <div class="oneCourseWrapper">
            <div class="courseDesc">
                <div class="onliOneCourse">
                    <div class="plate">
                        <img src="{{ URL::asset('images/icon/'.$chosencourse->image) }}" alt="Изображение отсутствует">
                    </div>
                </div>

                <div class="course_desc">
                    <div class="lightGrayLine">Описание курса:</div>
                    <div class="underGrayLine">
                        <div>{{ $chosencourse->cdesc }}</div>

                        @if ($usachek == 1)
                            <div>
                                <button class="button buttonchange" type="submit">Редактирование описания курса</button>
                                <form class="changeForm" action="{{ action('HomeController@changeCourseDesc', ['id' => $chosencourse->id]) }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <textarea name="cdesc" rows="5">{{ $chosencourse->cdesc }}</textarea>
                                    <button class="button" type="submit">Изменить описание курса</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <div class="lightGrayLine">Требования к слушателю:</div>
                <div class="underGrayLine">
                    <div>{{ $chosencourse->requirements }}</div>

                    @if ($usachek == 1)
                        <div>
                            <button class="button buttonchange" type="submit">Редактирование требований к слушателю</button>
                            <form class="changeForm" action="{{ action('HomeController@changeCourseReq', ['id' => $chosencourse->id]) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <textarea name="requirement" rows="5">{{ $chosencourse->requirements }}</textarea>
                                <button class="button" type="submit">Изменить требования</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <div class="lightGrayLine">Для кого предназначен курс:</div>
                <div class="underGrayLine">
                    <div>{{ $chosencourse->forWhom }}</div>
                    @if ($usachek == 1)
                        <div>
                            <button class="button buttonchange" type="submit">Редактирование ареала слушателей</button>
                            <form class="changeForm" action="{{ action('HomeController@changeCourseWhom', ['id' => $chosencourse->id]) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <textarea name="whom" rows="5">{{ $chosencourse->forWhom }}</textarea>
                                <button class="button" type="submit">Изменить ареал слушателей</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lections">
                <div class="lightGrayLine"> Видеоуроки:</div>
                @foreach($lections as $index => $lection)
                    @if( $lection->idcourse == $chosencourse->id)
                        <div class="lectionInCourse">
                            <video controls>
                                <source src="{{ URL::asset('gruntFiles/videos/'.$lection->ltitle) }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                                <source src="{{ URL::asset('gruntFiles/videos/'.$lection->ltitle) }}" type='video/ogg; codecs="theora, vorbis"'>
                                <source src="{{ URL::asset('gruntFiles/videos/'.$lection->ltitle) }}" type='video/webm; codecs="vp8, vorbis"'>
                            </video>

                            <div class="lectionContent">
                                <span class="darkGrayLine">
                                   {{ substr($lection->ltitle, 0, strripos($lection->ltitle, '.')) }}
                                </span>

                                <div class="underGrayLine">
                                    <div>
                                        <div>
                                            {{ $lection->ldesc }}
                                        </div>

                                        @if ($usachek == 1)
                                            <div>
                                                <button class="button buttonchange" type="submit">Редактирование описания видеоурока</button>
                                                <form class="changeForm" action="{{ action('HomeController@changeLecDesc', ['id' => $lection->id]) }}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <textarea name="comment" rows="5">{{ $lection->ldesc }}</textarea>
                                                    <button class="button" type="submit">Изменить описание</button>
                                                </form>
                                            </div>

                                        @endif
                                    </div>

                                    {{--Metod--}}
                                    @foreach($addmats as $addmat)
                                        @if($addmat->idaddlec == $lection->id)
                                            <div class="addmat">
                                                <a href="{{URL::asset('gruntFiles/addmats/'.$addmat->addtitle)}}">{{ substr($addmat->addtitle, 0, strripos($addmat->addtitle, '.'))  }}</a>

                                                @if ($usachek == 1)
                                                    <form onsubmit="return confirm('Файл будет безвозвратно удалён. Вы уверены?')" action="{{ action('HomeController@deleteTableRecord', ['id' => $addmat->id]) }}" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="name" value="{{ $addmat->addtitle }}">
                                                        <button class="button" type="submit">Удалить документ</button>
                                                    </form>
                                                @endif

                                            </div>
                                        @endif
                                    @endforeach

                                    @if ($usachek == 1)
                                        <div>
                                            <form class="add_method" action="{{ action('HomeController@addTableRecord', ['id' => $lection->id]) }}" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input {{--multiple="multiple"--}} name="userfile" type="file">
                                                <button class="button" type="submit">Добавить новый документ</button>
                                            </form>
                                        </div>

                                        <form onsubmit="return confirm('Видеурок будет безвозвратно удалён. Вы уверены?')" action="{{ action('HomeController@deleteLection', ['id' => $lection->id]) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="name" value="{{ $lection->ltitle }}">
                                            <button class="button" type="submit">Удалить видеурок</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @if(Session::has('message'))

                <div class="alertMessaga">
                    {!!Session::get('message')!!}
                </div>
            @endif

            @if ($usachek == 1)
                <button class="greenButton buttonLecChange" type="submit">Новый видеурок</button>
                <form id="add_video" class="changeLecForm" action="{{ action('HomeController@addLection', ['id' => $chosencourse->id]) }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <ul class="input-group form-control">
                        <li><input type="text" id="lalala" name="ltitle" placeholder="Название видеурока" required></li>
                        <li><textarea rows="5" name="ldesc" placeholder="Описание видеурока" required></textarea></li>
                    </ul>
                    <input {{--multiple="multiple"--}} name="videofile{{--[]--}}" type="file" accept="video/*">
                    <button type="submit" class="greenButton">Добавить видеоурок</button>
                </form>
            @endif
        </div>
    </div>

@stop