<?php

namespace App\Admin\Actions\Grid;

use App\Models\Movie;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateStatusAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '更新状态';

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

        $movie_id = $this->getKey();
        Movie::query()->where('id', $movie_id)->update(['status' => 2]);
        return $this->response()
            ->success('Processed successfully: ' . $this->getKey())
            ->refresh();
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return [
            "电影",
            "您确定要下架吗？",
        ];
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
