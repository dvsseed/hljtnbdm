<?php namespace App\Http\Controllers\Admin;

use App\User;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExcelController extends Controller {

    /**
     * 得到人员名单，下载Excel文档
     */
    public function xlsUsers()
    {
        $users = $this->getUsersDatas();

        Excel::create('人员信息表', function($excel) use($users) {
            $excel->sheet('users', function($sheet) use($users) {
                    $sheet->fromArray($users, null, 'A1', false, false);
                    $sheet->prependRow(1, array('编号', '帐号', '姓名', '医院', '部门编号', '部门', '职务代码', '职务', '手机', '邮箱'));
                    $sheet->setWidth([
                        'A' => 10,
                        'B' => 20,
                        'C' => 10,
                        'D' => 12,
                        'E' => 10,
                        'F' => 12,
                        'G' => 10,
                        'H' => 14,
                        'I' => 18,
                        'J' => 24,
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
        return User::where('is_admin', 0)->select('id', 'account', 'name', 'hospital', 'departmentno', 'department', 'positionno', 'position', 'phone', 'email')->get()->toArray();
    }

    /**
     * 获取人员数组
     */
    public function getGradeDatas()
    {
        $grades = Grade::select('user_id', 'id', 'math', 'english', 'c', 'sport', 'think', 'soft')->get()->toArray();
        foreach ($grades as $key => $value) {
            $grades[$key]['id'] = User::findOrFail($value['user_id'])->name;
        }
        return $grades;
    }

}
