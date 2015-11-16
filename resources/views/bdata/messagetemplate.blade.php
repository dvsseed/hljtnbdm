<table  style="margin-right: 10px" id="message_table">
    @foreach($messages as $message)
        <tr><td style="width: 100px; min-width: 100px"><h3 >{{$message -> sender_id}}</h3></td><td><h3> : </h3></td><td style="text-align: left;padding-right: 30px; font-size: 24px;"><div style="word-wrap: break-word;width:800px">{{$message -> message}}</div></td><td style="width: 140px;min-width: 140px;">{{$message -> created_at}}</td></tr>
    @endforeach

</table>
<input id="message_count" type="hidden" value="{{count($messages)}}">

