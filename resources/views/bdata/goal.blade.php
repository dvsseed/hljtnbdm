<div id="goal" class="content" style="display: none">
    <table class="table">
        <tr>
            <td>
                <div style="line-height: 36px">
                Hba1c区间
                    </div>
            </td>
            <td>
                <select id="hba1c_goal" class="form-control">
                    <option @if(isset($goal) && $goal == 1) selected @endif value="1"><6.5</option>
                    <option @if(isset($goal) && $goal == 2) selected @endif value="2" selected>6.5(含)~6.9</option>
                    <option @if(isset($goal) && $goal == 3) selected @endif value="3">7(含)~7.4</option>
                    <option @if(isset($goal) && $goal == 4) selected @endif value="4">8(含)~8.5</option>
                </select>
            </td>
            <td>
                {!! Form::open(array('url'=>'post_hba1c_goal','method'=>'POST', 'id'=>'hba1c_goal_form')) !!}
                {!! Form::button('储存', array('class'=>'btn btn-default', 'id'=>'hba1c_goal_save')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
</div>