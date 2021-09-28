<?php

namespace Orcsor\DcatUeditor;

use Dcat\Admin\Models\Extension;
use Illuminate\Support\Arr;

class Ueditor extends Extension
{
    const NAME = 'ueditor';

    protected $serviceProvider = DcatUeditorServiceProvider::class;

    public static function getUploadConfig($key = null, $default = null)
    {
        $config = config('ueditor') ?: (include __DIR__ . '/../config/ueditor.php');

        if ($key === null) {
            return $config;
        }

        return Arr::get($config, $key, $default);
    }

}
