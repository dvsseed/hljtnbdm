<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table>
                <tr>
                    @if($object == 0 || $object == 1 || $object == 2 || $object == 3 || $object == 7 || $object == 8 || $object == 9 || $object == 10 || $object == 14 || $object == 15 || $object == 16 || $object == 17)
                        <th colspan="4">{{ $header }}</th>
                    @elseif($object == 4 || $object == 11 || $object == 18)
                        <th colspan="15">{{ $header }}</th>
                    @elseif($object == 5 || $object == 12 || $object == 19)
                        <th colspan="20">{{ $header }}</th>
                    @elseif($object == 6 || $object == 13 || $object == 20)
                        <th colspan="16">{{ $header }}</th>
                    @endif
                </tr>
                <tr>
                    @if($object == 0 || $object == 1 || $object == 2 || $object == 3 || $object == 7 || $object == 8 || $object == 9 || $object == 10 || $object == 14 || $object == 15 || $object == 16 || $object == 17)
                        <th>指标项目</th>
                        <th>切点</th>
                        <th>笔数</th>
                        <th>百分比</th>
                    @elseif($object == 4 || $object == 11 || $object == 18)
                        <th>ID</th>
                        <th>姓名</th>
                        <th>生日</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>罹病年</th>
                        <th>教育程度</th>
                        <th>身高</th>
                        <th>体重</th>
                        <th>BMI</th>
                        <th>腰围</th>
                        <th>吸烟</th>
                        <th>饮酒</th>
                        <th>牙周病</th>
                        <th>咀嚼</th>
                    @elseif($object == 5 || $object == 12 || $object == 19)
                        <th>ID</th>
                        <th>姓名</th>
                        <th>生日</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>罹病年</th>
                        <th>教育程度</th>
                        <th>身高</th>
                        <th>体重</th>
                        <th>肾病变</th>
                        <th>周边血管病变</th>
                        <th>神经病变</th>
                        <th>视网膜病变</th>
                        <th>白内障</th>
                        <th>冠心病</th>
                        <th>脑中风</th>
                        <th>失明</th>
                        <th>洗肾</th>
                        <th>下肢截肢</th>
                        <th>高低血糖就医</th>
                    @elseif($object == 6 || $object == 13 || $object == 20)
                        <th>ID</th>
                        <th>姓名</th>
                        <th>生日</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>罹病年</th>
                        <th>教育程度</th>
                        <th>身高</th>
                        <th>体重</th>
                        <th>BMI</th>
                        <th>A1C</th>
                        <th>LDL</th>
                        <th>TG</th>
                        <th>eGFR</th>
                        <th>BP</th>
                        <th>BP</th>
                    @endif
                </tr>
                @if($object == 0)
                    @include('quality.list0')
                @elseif($object == 1)
                    @include('quality.list1')
                @elseif($object == 2)
                    @include('quality.list2')
                @elseif($object == 3)
                    @include('quality.list3')
                @elseif($object == 4)
                    @include('quality.list4')
                @elseif($object == 5)
                    @include('quality.list5')
                @elseif($object == 6)
                    @include('quality.list6')
                @elseif($object == 7)
                    @include('quality.list0')
                @elseif($object == 8)
                    @include('quality.list1')
                @elseif($object == 9)
                    @include('quality.list2')
                @elseif($object == 10)
                    @include('quality.list3')
                @elseif($object == 11)
                    @include('quality.list4')
                @elseif($object == 12)
                    @include('quality.list5')
                @elseif($object == 13)
                    @include('quality.list6')
                @elseif($object == 14)
                    @include('quality.list0')
                @elseif($object == 15)
                    @include('quality.list1')
                @elseif($object == 16)
                    @include('quality.list2')
                @elseif($object == 17)
                    @include('quality.list3')
                @elseif($object == 18)
                    @include('quality.list4')
                @elseif($object == 19)
                    @include('quality.list5')
                @elseif($object == 20)
                    @include('quality.list6')
                @endif
            </table>
        </div>
    </div>
</div>
</body>

</html>