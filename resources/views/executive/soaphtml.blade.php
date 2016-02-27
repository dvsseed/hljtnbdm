<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        @if($type == 'soap')
            @if(isset($personal) && $personal)
                @include('executive.personsoap')
            @else
                @include('executive.soap')
            @endif

        @elseif($type == 'exec')
            @if(isset($personal) && $personal)
                @include('executive.person')
            @else
                @include('executive.list')
            @endif
        @endif
    </body>
</html>