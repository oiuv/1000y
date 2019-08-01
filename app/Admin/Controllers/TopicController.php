<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TopicController extends Controller
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

            $content->header('网站文章管理');
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

            $content->header('网站文章管理');
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

            $content->header('网站文章管理');
            $content->description('');

            $content->body($this->form());
        });
    }
    
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Article::findOrFail($id), function (Show $show) {

                $show->id();
                $show->title('标题');
                $show->body('内容');

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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title()->display(function () {
                $url = url('topics/'.$this->id);
                return "<a href='$url' target='_blank'>$this->title</a>";
            });
            $grid->account()->char1('作者');

            $grid->created_at('发布时间');
            $grid->updated_at('更新时间');

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
                $filter->like('title', '标题');
                $filter->like('account.char1', '作者');
                $filter->between('created_at', '发布时间')->datetime();

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
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title');
            $form->summernote('body');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
