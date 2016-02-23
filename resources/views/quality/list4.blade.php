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
    <td>{{ $list->cl_bmi }}</td>
    <td>{{ $list->cl_waist }}</td>
    <td>{{ $list->cl_smoking }}</td>
    <td>{{ $list->drinking }}</td>
    <td>{{ $list->periodontal }}</td>
    <td>{{ $list->masticatory }}</td>
</tr>
@endforeach
