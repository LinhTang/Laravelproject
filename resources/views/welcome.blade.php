<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Signika:700,300,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body { 
                height: 100%; 
                }
            body { 
                display: flex; 
                justify-content: center; 
                align-items: center; 
                text-align:center; 
                background:white; 
                overflow:hidden; 
                }
            h1 {
               font-size:5em;
               font:bold 7.5vw/1.6 'Signika', sans-serif;
               user-select:none;
               margin-top: -100px;
            }

            h1 span { display:inline-block; animation:float .2s ease-in-out infinite; }
            @keyframes float {
               0%,100%{ transform:none; }
               33%{ transform:translateY(-1px) rotate(-2deg); }
               66%{ transform:translateY(1px) rotate(2deg); }
            }
            body:hover span { animation:bounce .6s; }
            @keyframes bounce {
               0%,100%{ transform:translate(0); }
               25%{ transform:rotateX(20deg) translateY(2px) rotate(-3deg); }
               50%{ transform:translateY(-20px) rotate(3deg) scale(1.1);  }
            }

            span:nth-child(4n) { 
                color:hsl(50, 75%, 55%); 
                text-shadow:1px 1px hsl(50, 75%, 45%), 2px 2px hsl(50, 45%, 45%), 3px 3px hsl(50, 45%, 45%), 4px 4px hsl(50, 75%, 45%); }
            span:nth-child(4n-1) { 
                color:hsl(135, 35%, 55%); 
                text-shadow:1px 1px hsl(135, 35%, 45%), 2px 2px hsl(135, 35%, 45%), 3px 3px hsl(135, 35%, 45%), 4px 4px hsl(135, 35%, 45%); }
            span:nth-child(4n-2) { 
                color:hsl(155, 35%, 60%); 
                text-shadow:1px 1px hsl(155, 25%, 50%), 2px 2px hsl(155, 25%, 50%), 3px 3px hsl(155, 25%, 50%), 4px 4px hsl(140, 25%, 50%); }
            span:nth-child(4n-3) { 
                color:hsl(30, 65%, 60%); 
                text-shadow:1px 1px hsl(30, 45%, 50%), 2px 2px hsl(30, 45%, 50%), 3px 3px hsl(30, 45%, 50%), 4px 4px hsl(30, 45%, 50%); }

            h1 span:nth-child(2){ animation-delay:.05s; }
            h1 span:nth-child(3){ animation-delay:.1s; }
            h1 span:nth-child(4){ animation-delay:.15s; }
            h1 span:nth-child(5){ animation-delay:.2s; }
            h1 span:nth-child(6){ animation-delay:.25s; }
            h1 span:nth-child(7){ animation-delay:.3s; }
            h1 span:nth-child(8){ animation-delay:.35s; }
            h1 span:nth-child(9){ animation-delay:.4s; }
            h1 span:nth-child(10){ animation-delay:.45s; }
            h1 span:nth-child(11){ animation-delay:.5s; }
            h1 span:nth-child(12){ animation-delay:.55s; }
            h1 span:nth-child(13){ animation-delay:.6s; }
            h1 span:nth-child(14){ animation-delay:.65s; }
            h1 span:nth-child(15){ animation-delay:.7s; }
            h1 span:nth-child(16){ animation-delay:.75s; }


 
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
            .btn {
                font-size: 40px;
                border: solid;
                border-radius: 10px;
                width: 200px;
                padding: 10px;
                margin: 10px 10px 10px 0;
                color: gray;
                -webkit-transition-duration: 0.4s;
                transition-duration: 0.4s;
            }
            .btn:hover {
                background-color: #555555;
                color: white;
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
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <h1><span>T</span><span>H</span><span>E</span><span> </span>
                    <span>C</span><span>O</span><span>F</span><span>F</span><span>E</span><span>E</span><span> </span>
                    <span>S</span><span>H</span><span>O</span><span>P</span></h1>
                </div>
                <div>
                    @auth
                       <a class="btn btn-primary" href="{{ url('/home') }}">Home</a>
                    @else
                        <div>
                           <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                            @endif
                        </div>
                    @endauth
                </div>
                
                
            </div>
        </div>
    </body>
</html>
