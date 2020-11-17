<?php

namespace Qihucms\Feedback\Controllers\Admin;

use App\Admin\Controllers\Controller;
use App\Models\User;
use Qihucms\Feedback\Models\Feedback;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FeedbackController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员反馈';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Feedback);

        $grid->model()->orderBy('status', 'asc');

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('user.username', __('feedback::feedback.user_id'));
            $filter->like('title', __('feedback::feedback.title'));
            $filter->equal('status', __('feedback::feedback.status.label'))->select(__('feedback::feedback.status.value'));

        });

        $grid->column('id', __('feedback::feedback.id'));
        $grid->column('user.username', __('feedback::feedback.user_id'));
        $grid->column('title', __('feedback::feedback.title'));
        $grid->column('status', __('feedback::feedback.status.label'))
            ->using(__('feedback::feedback.status.value'));
        $grid->column('created_at', __('admin.created_at'));
        $grid->column('updated_at', __('admin.updated_at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Feedback::findOrFail($id));

        $show->field('id', __('feedback::feedback.id'));
        $show->field('user_id', __('feedback::feedback.user_id'))
            ->as(function () {
                return $this->user ? $this->user->username : '会员不存在';
            });
        $show->field('title', __('feedback::feedback.title'));
        $show->field('content', __('feedback::feedback.content'))->unescape();
        $show->field('file', __('feedback::feedback.file'))->image();
        $show->field('reply', __('feedback::feedback.reply'))->unescape();
        $show->field('contact', __('feedback::feedback.contact'));
        $show->field('status', __('feedback::feedback.status.label'))
            ->using(__('feedback::feedback.status.value'));
        $show->field('created_at', __('admin.created_at'));
        $show->field('updated_at', __('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Feedback);

        $form->select('user_id', __('feedback::feedback.user_id'))
            ->options(function ($id) {
                $user = User::find($id);
                if ($user) {
                    return [$user->id => $user->username];
                }
            })
            ->ajax(route('api.article.select.users.q'))
            ->required();
        $form->text('title', __('feedback::feedback.title'))->readonly();
        $form->textarea('content', __('feedback::feedback.content'))->readonly();
        $form->text('contact', __('feedback::feedback.contact'))->readonly();
        $form->image('file', __('feedback::feedback.file'))->readonly();
        $form->UEditor('reply', __('feedback::feedback.reply'));
        $form->select('status', __('feedback::feedback.status.label'))
            ->options(__('feedback::feedback.status.value'));

        return $form;
    }
}
