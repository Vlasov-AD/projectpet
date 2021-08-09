<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
        @yield('title')
        

    </head>
    <body>
        <div>

        <script type="text/javascript">
        //обновление страницы, если переход был через кнопку назад
            if(performance.navigation.type == 2){
                location.reload(true);
            }
        </script>

        @include('includesSite.navBar')

        @include('includesSite.header')
        
    	@yield('content')

        @include('includesSite.footer')

        </div>
    </body>
</html>