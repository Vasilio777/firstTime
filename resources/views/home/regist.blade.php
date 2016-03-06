
{{--Регистрация, не активна--}}

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" type="text/css">
    <link rel="shortcut icon" href="{{ URL::asset('images/unnamed.png') }}" type="image/x-icon">
    <title>Регистрация</title>
</head>

<body>
    <header>
        <div>Регистрация</div>
    </header>

   <div id="wrapper">

       <div class="indexRegist">
           <div class="heading">
               <span>Заполните регистрационную форму</span>

               <form action="{{ action('AdvancedReg@register') }}" id="oneForm" style="display: none">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">

                   <ul class="input-group form-control">
                       <li><input type="text" name="name" required placeholder="Имя"></li>
                       <li><input type="text" name="surname" required placeholder="Фамилия"></li>
                       <li><input type="text" name="patronymic" required placeholder="Отчество"></li>
                       <li><input type="email" name="email" required placeholder="Mail"></li>
                       <li><input type="password" name="password" required placeholder="Пароль"></li>
                       {{--<li><input type="hidden" name="isPrepod" value="1" ></li>--}}
                       <li><input type="password" required  name='password_confirmation' placeholder="Повторите пароль"></li>
                   </ul>
                   <button class="enterButton">Регистрация</button>
               </form>

               <form action="{{ action('AdvancedReg@register') }}" id="twoForm" style="display: none">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">

                   <ul class="input-group form-control">
                       <li><input type="text" name="name" required placeholder="Имя"></li>
                       <li><input type="text" name="surname" required placeholder="Фамилия"></li>
                       <li><input type="text" name="patronymic" required placeholder="Отчество"></li>
                       <li><input type="email" name="email" required placeholder="Mail"></li>
                       <li><input type="password" required name="password" placeholder="Пароль"></li>
                       <li><input type="password" required name='password_confirmation' placeholder="Повторите пароль"></li>
                   </ul>
                   <button class="enterButton">Регистрация</button>
               </form>

               {{--<a href="{{  url('regist') }}">Преподаватель</a>--}}

           </div>
       </div>

       @if (count($errors) > 0)

           <div class="alertMessaga">
               <span>Вы допустили ошибку.</span>

               <ul>

                   @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach

               </ul>

               <span> Попробуйте ещё раз.</span>
           </div>

       @endif

   </div>
<script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.0.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/record.js') }}"></script>
</body>
</html>
