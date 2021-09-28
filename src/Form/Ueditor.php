<?php

namespace Orcsor\DcatUeditor\Form;

use Dcat\Admin\Form\Field;
use Illuminate\Support\Str;

class Ueditor extends Field
{

    protected static $js = [
        '@extension/orcsor/dcat-ueditor/ueditor.config.js',
        '@extension/orcsor/dcat-ueditor/ueditor.all.min.js',
    ];

    protected $view = 'ueditor::ueditor';

    protected $options = [
        // 编辑器默认高度
        'initialFrameHeight' => 400,
        'maximumWords' => 100000,
        'serverUrl' => '',
    ];

    protected $disk;

    /**
     * 设置编辑器高度
     *
     * @param int $height
     *
     */
    public function height(int $height)
    {
        $this->options['initialFrameHeight'] = $height;

        return $this;
    }

    public function render()
    {
        $this->setupScript();

        return parent::render();
    }

    /**
     * 初始化js
     */
    protected function setupScript()
    {

        $id = uniqid('ueditor-', false);

        $this->addVariables(compact('id'));

        $opts = $this->formatOptions();

        $cls = $this->getElementClassSelector() . '_wrapper';

        $this->script = <<<JS
(function () {
    var ue = UE.getEditor('{$id}', {$opts});
    ue.ready(function () {
        ue.setContent($('$cls').html());
        ue.execCommand('serverparam', '_token', Dcat.token);
        ue.execCommand('serverparam', 'disk', '{$this->disk}');
    })
})();
JS;

    }

    /**
     * @return string
     */
    protected function formatOptions()
    {
        if (empty($this->options['serverUrl'])) {
            $this->server('/ueditor/serve');
        }

        return json_encode($this->options);
    }

    /**
     * 设置上传接口
     *
     * @param string $url
     *
     * @return $this
     */
    public function server(string $url)
    {
        $this->options['serverUrl'] = url()->isValidUrl($url) ? $url : admin_base_path($url);

        return $this;
    }

    /**
     * @param string $disk
     *
     * @return $this
     */
    public function disk($disk)
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * Get the view variables of this field.
     *
     * @return array
     */
    public function variables()
    {
        return array_merge(parent::variables(), [
            'homeUrl' => admin_asset('@extension/orcsor/dcat-ueditor') . '/',
        ]);
    }

}
