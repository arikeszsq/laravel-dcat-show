<?php

namespace App\Admin\Forms;

use App\Models\Movie;
use Dcat\Admin\Widgets\Form;

class BatchDown extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        $id = explode(',', $input['id'] ?? null);
        if (!$id) {
            return $this->response()->error('参数错误');
        }

        Movie::query()->whereIn('id', $id)->update(['status' => 2]);

        return $this
            ->response()
            ->success('Processed successfully.')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('name')->required();
        $this->email('email')->rules('email');
        $this->hidden('id')->attribute('id', 'reset-password-id');
        $this->confirm('您确定要提交表单吗', 'content');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
        ];
    }
}
