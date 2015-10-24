<table style="width: 100%; margin-right: 10px" id="message_table">
    @foreach($messages as $message)
        <tr><td style="width: 100px"><h3 >{{$user[$message -> sender_id]}}</h3></td><td><h3> : </h3></td><td style="text-align: left;padding-right: 30px"><h3 style="background-color: #F9E3D7; padding: 20px 0">{{$message -> message}}</h3></td></tr>
    @endforeach

</table>
<input id="message_count" type="hidden" value="{{count($messages)}}">

