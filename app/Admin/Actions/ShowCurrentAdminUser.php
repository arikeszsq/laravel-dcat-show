<?php

namespace App\Admin\Actions;

use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Table;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShowCurrentAdminUser extends Action
{
    /**
     * @return string
     */
	protected $title = '个人信息';

    protected $modalId = 'show-current-user';


    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // 获取当前登录用户模型
        $user = Admin::user();
        // 这里我们用表格展示模型数据
        $table = Table::make($user->toArray());

        return $this->response()
            ->success('查询成功')
            ->html($table);

    }

    /**
     * 处理响应的HTML字符串，附加到弹窗节点中
     *
     * @return string
     */
    protected function handleHtmlResponse()
    {
        return <<<'JS'
function (target, html, data) {
    var $modal = $(target.data('target'));

    $modal.find('.modal-body').html(html)
    $modal.modal('show')
}
JS;
    }

    /**
     * 设置HTML标签的属性
     *
     * @return void
     */
    protected function setupHtmlAttributes()
    {
        // 添加class
        $this->addHtmlClass('btn btn-primary');

        // 保存弹窗的ID
        $this->setHtmlAttribute('data-target', '#'.$this->modalId);

        parent::setupHtmlAttributes();
    }

    /**
     * 设置按钮的HTML，这里我们需要附加上弹窗的HTML
     *
     * @return string|void
     */
    public function html()
    {
        // 按钮的html
        $html = parent::html();

        return <<<HTML
{$html}
<div class="modal fade" id="{$this->modalId}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{$this->title()}</h4>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
HTML;
    }

    /**
     * 确认弹窗信息，如不需要可以删除此方法
     *
     * @return string|void
     */
    public function confirm()
    {
        // return ['Confirm?', 'contents'];
    }

    /**
     * 动作权限判断，返回false则表示无权限，如果不需要可以删除此方法
     *
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * 通过这个方法可以设置动作发起请求时需要附带的参数，如果不需要可以删除此方法
     *
     * @return array
     */
    protected function parameters()
    {
        return [];
    }

}
