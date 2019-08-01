<?php

namespace App\Admin\Controllers;

use App\Models\Comment;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ReplyController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('回帖内容');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('回帖内容');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('回帖内容');
            $content->description('');

            $content->body($this->form());
        });
    }
    
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Comment::findOrFail($id), function (Show $show) {

                $show->id();
                $show->article()->title('文章');
                $show->content('回帖');

                //$show->created_at();
                //$show->updated_at();
            }));
        });
    }
    
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Comment::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->article()->title('文章');
            $grid->content('内容')->display(function ($value) {
                return "<button type=\"button\" class=\"btn btn-default btn-sm\" data-toggle=\"tooltip\"
        title=\"$value\">
    回帖内容
</button>";
            });
            $grid->account()->char1('玩家');
            $grid->created_at('回帖时间');
            //$grid->updated_at();

            $grid->model()->orderBy('id', 'desc');
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                //$actions->disableEdit();
            });
            $grid->filter(function ($filter) {

                // Remove the default id filter
                $filter->disableIdFilter();

                // Add a column filter
                $filter->like('account.char1', '玩家');
                $filter->between('created_at', '回帖时间')->datetime();

            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Comment::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->summernote('content');

            //$form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
