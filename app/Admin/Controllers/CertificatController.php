<?php

namespace App\Admin\Controllers;

use App\Models\Certificat;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;
use SebastianBergmann\Diff\Diff;

class CertificatController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Certificat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Certificat());
        $admin = new Admin();


        if ($admin->user()->id != 1) {
            $grid->model()->where([
                ['admin_user_id', '=', $admin->user()->id],
            ]);
        }

        $grid->column('id', __('Id'));
        $grid->column('lito_id', __('Lito id'))->display(function ($title) {

            return "<span style='color:blue'><a href = 'works/lithography/" . $title . "' >$title</a></span>";
        });
        $grid->column('tableau_id', __('Tableau id'))->display(function ($title) {

            return "<span style='color:blue'><a href = 'works/paintings/" . $title . "' >$title</a></span>";
        });
        $grid->column('sculpture_id', __('Sculpture id'))->display(function ($title) {

            return "<span style='color:blue'><a href = 'works/sculptures/" . $title . "' >$title</a></span>";
        });
        $grid->column('code_certificat', __('Code certificat'));
        $grid->column('created_at', __('Created at'))->diffForHumans();
        $grid->column('updated_at', __('Updated at'))->hide();

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
        $show = new Show(Certificat::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('lito_id', __('Lito id'));
        $show->field('tableau_id', __('Tableau id'));
        $show->field('sculpture_id', __('Sculpture id'));
        $show->field('code_certificat', __('Code certificat'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Certificat());

        $form->number('lito_id', __('Lito id'));
        $form->number('tableau_id', __('Tableau id'));
        $form->number('sculpture_id', __('Sculpture id'));
        $form->text('code_certificat', __('Code certificat'));

        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        
        return $form;
    }
}
