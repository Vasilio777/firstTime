@extends('app')

@section('header')

    <header>
        <div>

        </div>
    </header>

@stop

@section('lections')

    <div id="baseUl">
        <ul>
            <li>
                <span>{{ $chosenlections->ltitle }}</span>
            </li>
        </ul>

        <br>
        <div id="ldesc">
            <div>{{  $chosenlections->ldesc }}</div>

            @if ($usachek == 1)
                <button class="button buttonLecChange" type="submit">Редактирование описания</button>

                <form class="changeLecForm" action="{{ action('HomeController@changeLecDesc', ['id' => $chosenlections->id]) }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <textarea name="comment" rows="4">{{ $chosenlections->ldesc }}</textarea>
                    <div class="divCenterButton"> <button class="button buttonRed" type="submit">Изменить описание</button> </div>
                </form>
            @endif

        </div>
    </div>

@stop

@section('buttons')

    <ul id="otherContent" class="accordion">
        <!--        ВИДЕО  ------------------------------------------------>
        <li>
            <div class="link">Видеоматериалы</div>

            <ul class="submenu">

                @foreach($videos as $index => $video)
                    @if( $video->idvlec == $chosenlections->id)
                        <li>
                            <div class="mainOtherContent">

                                <video controls="controls">
                                    <source src="{{ URL::asset('gruntFiles/videos/'.$video->vtitle) }}" type='video/ogg; codecs="theora, vorbis"'>
                                    <source src="{{ URL::asset('gruntFiles/videos/'.$video->vtitle) }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                                    <source src="{{ URL::asset('gruntFiles/videos/'.$video->vtitle) }}" type='video/webm; codecs="vp8, vorbis"'>
                                </video>

                                <div class="aboutVideo">
                                    <span class="vtitle">{{ substr($video->vtitle, 0, strripos($video->vtitle, '.')) }}</span>

                                    <br>
                                    <span class="vdesc">{{ $video->vdesc }}</span>

                                    @if ($usachek == 1)
                                       <button class="button buttonchange" type="submit">Редактирование описания</button>

                                        <form class="changeForm" action="{{ action('HomeController@changeVideoDesc', ['id' => $chosenlections->id]) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $video->id }}">
                                            <textarea name="comment" rows="5">{{ $video->vdesc }}</textarea>
                                            <div class="divCenterButton"><button class="button buttonRed" type="submit">Изменить описание</button></div>
                                        </form>

                                        <form onsubmit="return confirm('Файл будет безвозвратно удалён. Вы уверены?')" action="{{ action('HomeController@deleteVideo', ['id' => $chosenlections->id]) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $video->id }}">
                                            <input type="hidden" name="name" value="{{ $video->vtitle }}">
                                            <button class="button" type="submit">Удалить</button>
                                        </form>
                                    @endif

                                    {{--<form action="{{ action('HomeController@incremVideo', ['id' => $chosenlections->id]) }}" method="post">--}}
                                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                        {{--<input type="hidden" name="id" value="{{ $video->id }}">--}}
                                        {{--<input type="hidden" name="name" value="{{ $video->vtitle }}">--}}
                                        {{--<button class="button" type="submit">внииииз</button>--}}
                                    {{--</form>--}}

                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach

                @if ($usachek == 1)
                    <li>
                        <div class="mainOtherContent">

                            <form id="add_video" action="{{ action('HomeController@addVideo', ['id' => $chosenlections->id]) }}" method="post" enctype="multipart/form-data">
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

                @foreach($addmats as $addmat)
                    @if($addmat->idaddlec == $chosenlections->id)
                        <li>
                            <div class="mainOtherContent addContent">
                                <a class="addmat" href="{{URL::asset('gruntFiles/addmats/'.$addmat->addtitle)}}">{{ substr($addmat->addtitle, 0, strripos($addmat->addtitle, '.'))  }}</a>

                                @if ($usachek == 1)
                                    <form  class="delMethod" onsubmit="return confirm('Файл будет безвозвратно удалён. Вы уверены?')" action="{{ action('HomeController@deleteTableRecord', ['id' => $chosenlections->id]) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $addmat->id }}">
                                        <input type="hidden" name="name" value="{{ $addmat->addtitle }}">
                                        <button class="button" type="submit">Удалить</button>
                                    </form>
                                @endif

                            </div>
                        </li>
                    @endif
                @endforeach

                @if ($usachek == 1)
                    <li>
                        <div class="mainOtherContent">

                            <form id="add_method" action="{{ action('HomeController@addTableRecord', ['id' => $chosenlections->id]) }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input {{--}}multiple="multiple"--}} name="userfile{{--[]--}}" type="file">
                                <button class="button" type="submit">Добавить новый документ</button>
                            </form>
                        </div>
                    </li>
                @endif

            </ul>
        </li>

        <!--           ИСХОДНИКИ  ---------------------------------------->
        <li>
            <div class="link">Исходные данные</div>

            <ul class="submenu">
                <li>
                    <div class="mainOtherContent">
                    bbaabab
                    </div>
                </li>

                <li>
                    <div class="mainOtherContent">
                    2bababab
                    </div>
                </li>
            </ul>
        </li>
    </ul>

@stop

