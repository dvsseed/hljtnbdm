<?php namespace App\Http\Controllers\Quality;

use App\User;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExcelController extends Controller {

    /**
     * 得到人员名单，下载Excel文档
     */
    public function xlsx($obj)
    {
        switch ($obj) {
            case 0:
                $this->xlsx0('新登录_基本资料_总表');
                break;
            case 1:
                $this->xlsx1();
                break;
            case 2:
                $this->xlsx2();
                break;
            default:
                break;
        }
    }

    public function xlsx0($filename)
    {
        /*        $users = $this->getData0();
                Excel::create($filename, function($excel) use($users) {
                    $excel->sheet('统计表', function($sheet) use($users) {
                        $sheet->fromArray($users, null, 'A1', false, false);
                        $sheet->prependRow(1, '新登录_基本资料_总表');
                        $sheet->prependRow(2, array('指标项目', '切点', '笔数', '百分比'));
                        $sheet->setWidth([
                            'A' => 10,
                            'B' => 20,
                            'C' => 10,
                            'D' => 12,
                        ]);
                        $sheet->getDefaultStyle();
                    });
                })->export('xls');
        */
        Excel::create('New file', function($excel) {
            $excel->sheet('New sheet', function($sheet) {
                $sheet->loadView('quality.lists');
            });
        })->export('xls');
    }

    /**
     * @return 人员信息数组
     */
    public function getData0()
    {
        return User::where('is_admin', 0)->select('id', 'account', 'name', 'hospital', 'departmentno', 'department', 'positionno', 'position', 'phone', 'email')->get()->toArray();
    }

    /**
     * 获取人员数组
     */
/*    public function getGradeDatas()
    {
        $grades = Grade::select('user_id', 'id', 'math', 'english', 'c', 'sport', 'think', 'soft')->get()->toArray();
        foreach ($grades as $key => $value) {
            $grades[$key]['id'] = User::findOrFail($value['user_id'])->name;
        }
        return $grades;
    }
*/
}
