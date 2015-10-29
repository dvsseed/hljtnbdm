<button type="button" class="btn btn-warning" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" title="基础表" 
data-content="
@foreach($hiss as $key => $his)
#{{ $key+1 }}.
部门号 -- {{ $his->bmdm }}
部门名称 -- {{ $his->bmmc }}<br>
人员号 -- {{ $his->zgdm }}
人员名称 -- {{ $his->zgxm }}<br>
职务代码 -- {{ $his->zwdm }}
职务 -- {{ $his->zwmc }}<br>
@endforeach
">
查看HIS
</button>
