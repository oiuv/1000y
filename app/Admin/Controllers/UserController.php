<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
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

            $content->header('游戏账户管理');
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

            $content->header('游戏账户管理');
            $content->description('谨慎修改');

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

            $content->header('游戏账户管理');
            $content->description('');

            $content->body($this->form());
        });
    }

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Account::findOrFail($id), function (Show $show) {

                $show->id();
                $show->account('账号');
                $show->password('密码');
                $show->email();
                $show->char1('角色1');
                $show->char2('角色2');
                $show->char3('角色3');
                $show->char4('角色4');
                $show->char5('角色5');

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
        return Admin::grid(Account::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->account('账号');
            $grid->telephone();
            $grid->char1('角色1')->display(function ($value) {
                if (str_contains($value, ['封号']))
                    return "<span class='label label-danger'>$value</span>";
                else
                    return $value ?: '';
            });
            $grid->char2('角色2')->display(function ($value) {
                if (str_contains($value, ['封号']))
                    return "<span class='label label-danger'>$value</span>";
                else
                    return $value ?: '';
            });
            $grid->char3('角色3')->display(function ($value) {
                if (str_contains($value, ['封号']))
                    return "<span class='label label-danger'>$value</span>";
                else
                    return $value ?: '';
            });
            $grid->char4('角色4')->display(function ($value) {
                if (str_contains($value, ['封号']))
                    return "<span class='label label-danger'>$value</span>";
                else
                    return $value ?: '';
            });
            $grid->char5('角色5')->display(function ($value) {
                if (str_contains($value, ['封号']))
                    return "<span class='label label-danger'>$value</span>";
                else
                    return $value ?: '';
            });

            $grid->makedate();
            $grid->lastdate()->sortable();
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
                $filter->like('account', '账号');
                $filter->like('telephone', '手机');
                $filter->where(function ($query) {

                    $query->where('char1', 'like', "%{$this->input}%")
                        ->orWhere('char2', 'like', "%{$this->input}%")
                        ->orWhere('char3', 'like', "%{$this->input}%")
                        ->orWhere('char4', 'like', "%{$this->input}%")
                        ->orWhere('char5', 'like', "%{$this->input}%");

                }, '玩家角色');
                $filter->between('makedate', '注册时间')->datetime();
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
        return Admin::form(Account::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->display('account');
            $form->display('password');
            $form->mobile('telephone');
            $form->text('email'); // 不用$form->email()

            $form->text('char1');
            $form->text('char2');
            $form->text('char3');
            $form->text('char4');
            $form->text('char5');

            $form->display('makedate', 'Created At');
            $form->display('lastdate', 'Logined At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
