@foreach($count as $list)
<tr>
    <td>{{ $list->cl_patientid }}</td>
    <td>{{ $list->name }}</td>
    <td>{{ $list->birthday }}</td>
    <td>{{ $list->sex }}</td>
    <td>{{ $list->pp_age }}</td>
    <td>{{ $list->cc_mdate }}</td>
    <td>{{ $list->edu }}</td>
    <td>{{ $list->pp_height }}</td>
    <td>{{ $list->pp_weight }}</td>
    <td>{{ $list->stage }}</td>
    <td>{{ $list->complication3 }}</td>
    <td>{{ $list->complication2 }}</td>
    <td>{{ $list->eye8 }}</td>
    <td>{{ $list->cataract }}</td>
    <td>{{ $list->heart }}</td>
    <td>{{ $list->stroke }}</td>
    <td>{{ $list->blindness }}</td>
    <td>{{ $list->dialysis }}</td>
    <td>{{ $list->amputation }}</td>
    <td>{{ $list->treatment }}</td>
</tr>
@endforeach
