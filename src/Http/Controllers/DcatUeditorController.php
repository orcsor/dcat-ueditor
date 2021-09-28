<?php

namespace Orcsor\DcatUeditor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Session\Store;
use Orcsor\DcatUeditor\Storage;
use Orcsor\DcatUeditor\Ueditor;

class DcatUeditorController extends Controller
{
    /**
     * @var Storage
     */
    protected $storage;

    public function index(Request $request)
    {
        $upload = Ueditor::getUploadConfig();

        switch ($request->get('action')) {
            case 'config':
                return $upload;
            case $upload['imageManagerActionName']:
                return $this->storage()->listFiles(
                    $upload['imageManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['imageManagerAllowFiles']);

            case $upload['fileManagerActionName']:
                return $this->storage()->listFiles(
                    $upload['fileManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['fileManagerAllowFiles']);
            default:
                return $this->storage()->upload($request);
        }

        return 'hello';
    }

    protected function storage()
    {
        $disk = request()->get('disk');
        return $this->storage ?: ($this->storage = Storage::make($disk));
    }

}
