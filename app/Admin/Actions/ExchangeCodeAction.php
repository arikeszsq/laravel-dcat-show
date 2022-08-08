<?php

namespace App\Admin\Actions;

use App\Admin\Forms\ExchangeCodeForms;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ExchangeCodeAction extends Action
{
    /**
     * @return string
     */
	protected $title = '表单生成兑换码';


    /**
     * 渲染模态框.
     * @return
     */
    public function render()
    {
        // 这里直接创建一个modal框 model的内容由工具表单提供，这里也需要创建一个工具表单才行
        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body(ExchangeCodeForms::make())
            ->button("<button class='btn btn-sm btn-primary'>$this->title</button>"); // 这个button就是对应上面的按钮
    }


    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // dump($this->getKey());

        return $this->response()->success('Processed successfully.')->redirect('/');
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        // return ['Confirm?', 'contents'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
