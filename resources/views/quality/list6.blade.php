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
    <td>{{ $list->cl_blood_hba1c }}</td>
    <td>{{ $list->cl_ldl }}</td>
    <td>{{ $list->cl_tg }}</td>
    <td>{{ $list->cl_egfr }}</td>
    <td>{{ $list->cl_base_sbp }}</td>
    <td>{{ $list->cl_base_ebp }}</td>
</tr>
@endforeach
