<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ trans('app.attendance') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">{{ trans('auth.login') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ trans('app.attendance') }} {{ \Carbon\Carbon::now()->toDateTimeString() }}
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">{{ trans('app.docs') }}</a>
                    <a href="https://laracasts.com">{{ trans('app.laracast') }}</a>
                    <a href="https://laravel-news.com">{{ trans('app.news') }}</a>
                    <a href="https://blog.laravel.com">{{ trans('app.blog')}}</a>
                    <?php $mark = (preg_match('/\?/', url()->current())) ? '&' : '?'; ?>
                    @if(Lang::locale() == "en")
                    <a href="{{ url(url()->current() . $mark . 'lang=en') }}">en</a>
                    @elseif(Lang::locale() == "id")
                    <a href="{{ url(url()->current() . $mark . 'lang=id') }}">id</a>
                    @elseif(Lang::locale() == "ko")
                    <a href="{{ url(url()->current() . $mark . 'lang=ko') }}">ko</a>
                    @elseif(Lang::locale() == "je")
                    <a href="{{ url(url()->current() . $mark . 'lang=je') }}">je</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
