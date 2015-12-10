<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UploadsManager;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        dd('111');
        $this->middleware('admin');
        $this->manager = $manager;
    }

    /**
     * Show page of files / subfolders
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);
        return view('admin.upload.index', $data);
    }
}
