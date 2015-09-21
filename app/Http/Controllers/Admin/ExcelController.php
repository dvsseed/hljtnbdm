<?php namespace App\Http\Controllers\Admin;

// use App\Grade;
use App\User;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ExcelController extends Controller {

    /**
     * 得到人员名单，下载Excel文档
     */
    public function dmList()
    {
        $users = $this->getUsersDatas();

        Excel::create('人员信息表', function($excel) use($users) {

            $excel->sheet('users', function($sheet) use($users) {

                    $sheet->fromArray($users, null, 'A1', false, false);

                    $sheet->prependRow(1, array(
                        '编号', '姓名', '部门编号', '部门', '职务代码', '职务', '手机', '邮箱'
                    ));
                    $sheet->setWidth([
                        'A' => 6,
                        'B' => 10,
                        'C' => 6,
                        'D' => 12,
                        'E' => 6,
                        'F' => 10,
                        'G' => 12,
                        'H' => 20,
                        ]);
                    $sheet->getDefaultStyle();

            });

        })->export('xls');
    }

    /**
     * @return 人员信息数组
     */
    public function getUsersDatas()
    {
        return User::where('is_admin', 0)
                    ->select('id', 'name', 'departmentno', 'department', 'positionno', 'position', 'phone', 'email')
                    ->get()
                    ->toArray();
    }

    /**
     * 得到成绩表
     */
    public function grade()
    {
        $grades = $this->getGradeDatas();

        Excel::create('人员成绩表', function($excel) use($grades) {

            $excel->sheet('sheetName', function($sheet) use($grades) {

                $sheet->fromArray($grades, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    '编号', '姓名', '11', '22', '33', '44', '55', '66'
                    ));

                $sheet->setWidth([
                    'A' => 11,
                    'B' => 10,
                    'C' => 5,
                    'D' => 5,
                    'E' => 6,
                    'F' => 5,
                    'G' => 5,
                    'H' => 5,
                    ]);

            });
        })->export('xls');

    }

    /**
     * 获取人员成绩数组
     */
    public function getGradeDatas()
    {
        $grades = Grade::select('user_id', 'id', 'math',
            'english', 'c', 'sport', 'think', 'soft')->get()->toArray();

        foreach ($grades as $key => $value) {
            $grades[$key]['id'] = User::findOrFail($value['user_id'])->name;
        }

        return $grades;

    }

}
