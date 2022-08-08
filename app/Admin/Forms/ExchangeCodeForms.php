<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class ExchangeCodeForms extends Form
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
         dump($input);exit;

        // return $this->response()->error('Your error message.');

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
        $this->number('number', '生成数量')->rules('required');
        $this->number('expired_days', '有效期限（天）')->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
            'number'  => '1',
            'expired_days' => '1',
        ];
    }
}
