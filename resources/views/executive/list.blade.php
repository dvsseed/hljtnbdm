<meta charset="UTF-8">
<table>
    <tr>
        @foreach($records as $key=>$data)
            @if($first_key = key($data)) @endif
            <td>
                <table>
                    <tr>
                        <th colspan="4">{{$chart_title}}</th>
                    </tr>
                    <tr>
                        <th>@if($first_key == $key) 區間 @else {{$data['title']}} @endif</th>
                        <th>@if($first_key == $key) {{$data['title']}} @endif</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>A1C</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>總筆數</td>
                        <td>{{$data['data']['count']}}</td>
                        <td></td>
                        <td>百分比</td>
                    </tr>
                    @if(isset($data['data']['a1c']['mid']))
                        @foreach($data['data']['a1c']['mid'] as $doc => $count)
                            <tr>
                                <td></td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($data['data']['a1c']['low']))
                        @if($first = key($data['data']['a1c']['low'])) @endif
                        @foreach($data['data']['a1c']['low'] as $doc => $count)
                            <tr>
                                <td> @if($first===$doc) <7 @endif </td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($data['data']['a1c']['high']))
                        @if($first = key($data['data']['a1c']['high'])) @endif
                        @foreach($data['data']['a1c']['high'] as $doc => $count)
                            <tr>
                                <td> @if($first===$doc) >9 @endif </td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif

                    <tr>
                        <td>LDL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>總筆數</td>
                        <td>{{$data['data']['count']}}</td>
                        <td></td>
                        <td>百分比</td>
                    </tr>
                    @if(isset($data['data']['ldl']['mid']))
                        @foreach($data['data']['ldl']['mid'] as $doc => $count)
                            <tr>
                                <td></td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($data['data']['ldl']['low']))
                        @if($first = key($data['data']['ldl']['low'])) @endif
                        @foreach($data['data']['ldl']['low'] as $doc => $count)
                            <tr>
                                <td> @if($first===$doc) <7 @endif </td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($data['data']['ldl']['high']))
                        @if($first = key($data['data']['ldl']['high'])) @endif
                        @foreach($data['data']['ldl']['high'] as $doc => $count)
                            <tr>
                                <td> @if($first===$doc) >9 @endif </td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif

                    <tr>
                        <td>血壓</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>總筆數</td>
                        <td>{{$data['data']['count']}}</td>
                        <td></td>
                        <td>百分比</td>
                    </tr>
                    @if(isset($data['data']['bp']['mid']))
                        @foreach($data['data']['bp']['mid'] as $doc => $count)
                            <tr>
                                <td></td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($data['data']['bp']['low']))
                        @if($first = key($data['data']['bp']['low'])) @endif
                        @foreach($data['data']['bp']['low'] as $doc => $count)
                            <tr>
                                <td> @if($first===$doc) <7 @endif </td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($data['data']['bp']['high']))
                        @if($first = key($data['data']['bp']['high'])) @endif
                        @foreach($data['data']['bp']['high'] as $doc => $count)
                            <tr>
                                <td> @if($first===$doc) >9 @endif </td>
                                <td>{{$doc}} </td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </td>
        @endforeach
    </tr>
</table>