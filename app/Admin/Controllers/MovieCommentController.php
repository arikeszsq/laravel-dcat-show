<?php

namespace App\Admin\Controllers;

use App\Models\Movie;
use App\Models\MovieComment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MovieCommentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MovieComment(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('movie_id','电影')->display(function($movie_id){
                return Movie::query()->find($movie_id)->title;
            });
            $grid->column('content');
            $grid->column('creator');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

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
        return Show::make($id, new MovieComment(), function (Show $show) {
            $show->field('id');
            $show->field('movie_id');
            $show->field('content');
            $show->field('creator');
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
        return Form::make(new MovieComment(), function (Form $form) {
            $form->display('id');
            $form->text('movie_id');
            $form->text('content');
            $form->text('creator');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
