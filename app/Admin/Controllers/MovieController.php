<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\ExchangeCodeAction;
use App\Admin\Actions\Grid\TestBatchAction;
use App\Admin\Actions\Grid\TestRowAction;
use App\Admin\Actions\Grid\UpdateStatusAction;
use App\Admin\Actions\Grid\UpdateStatusBatchAction;
use App\Models\Movie;
use App\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\Tools;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MovieController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Movie(), function (Grid $grid) {
            $grid->rowSelector()->click();
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('director')->display(function ($director) {
                $user = User::query()->find($director);
                return $user->name;
            });
            $grid->column('describe')->width(300);
            $grid->column('rate');

            $grid->column('released', '上映?')->display(function ($released) {
                return $released ? '是' : '否';
            });

            $grid->column('created_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id', '编号')->width(3);
                $filter->between('created_at', '添加时间')->datetime()->width(6);
            });

            $grid->tools(function (Tools $tools) {
                $tools->append(ExchangeCodeAction::make());  //也可以直接 new ExchangeCodeAction() 这样就添加了一个按钮
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {

                $actions->append(new TestRowAction());


                $status = $actions->row->status;
                if ($status == 1) {
                    $actions->append(new UpdateStatusAction('<span class="btn btn-sm btn-primary">下架</span>'));
                }
            });

            $grid->batchActions(function (Grid\Tools\BatchActions $batch) {
                $batch->add(new UpdateStatusBatchAction());
                $batch->add(new TestBatchAction());

            });

        });


//        return Grid::make(Movie::with(['user', 'comments']), function (Grid $grid) {
//            $grid->rowSelector()->click();
//            $grid->column('id')->sortable();
//            $grid->column('title');
//            $grid->column('user.name','导演');
//            $grid->column('describe')->width(500);
//            $grid->column('created_at')->sortable();
//            $grid->filter(function (Grid\Filter $filter) {
//                $filter->equal('id', '编号')->width(3);
//                $filter->between('created_at', '添加时间')->datetime()->width(6);
//            });
//        });


    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Movie(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('director');
            $show->field('describe');
            $show->field('rate');
            $show->field('released');
            $show->field('release_at');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(Movie::with(['comments']), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();

            $directors = [
                1 => 'John',
                2 => 'Smith',
                3 => 'Kate',
            ];
//            $users = \App\Models\User::query()->select(['id', 'name'])->get();
//            foreach ($users as $user) {
//                $directors[$user->id] = $user->name;
//            }

            $form->select('director', '导演')->options($directors)->required();

            $form->textarea('describe');
            $form->number('rate');

            // 添加开关操作
            $form->switch('released', '发布？');
            $form->datetime('release_at');

            //json 表单
            $form->table('actors', function ($table) {
                $table->text('姓名');
            })->saving(function ($v) {
                return json_encode($v);
            })->label('演员');


            $form->hasMany('comments', function (Form\NestedForm $form) use ($directors) {
                $form->textarea('content', '评论内容');
                $form->select('creator', '评论人')->options($directors);
            })->label('评论');


            $form->image('logo')->autoUpload();


            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
