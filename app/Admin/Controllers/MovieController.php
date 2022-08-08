<?php

namespace App\Admin\Controllers;

use App\Models\Movie;
use App\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
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
            $grid->column('director');
            $grid->column('director')->display(function($userId) {
                return User::query()->find($userId)->name;
            });
            $grid->column('describe');
            $grid->column('rate');

            $grid->column('released', '上映?')->display(function ($released) {
                return $released ? '是' : '否';
            });

            $grid->column('created_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id','编号')->width(3);
                $filter->between('created_at', '添加时间')->datetime()->width(6);
            });
        });
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
        return Form::make(new Movie(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('director');
            $form->text('describe');
            $form->text('rate');
            $form->text('released');
            $form->text('release_at');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
