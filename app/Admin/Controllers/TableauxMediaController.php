<?php

namespace App\Admin\Controllers;

use App\Models\Lito;
use App\Models\Media;
use App\Models\Sculpture;
use App\Models\Tableau;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class TableauxMediaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Media';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Media());
        $grid->disableCreateButton();


        if (Admin::user()->id != 1) {

            $tab = Tableau::where('admin_user_id', '=', Admin::user()->id)->pluck('id');
            $grid->model()->whereIn('tableau_id', $tab);
        }

        $grid->column('image', __('Image'))->image();

        $grid->column('tableau_id', __('ID de l\'œuvre'))->display(function ($title) {

            return "<span style='color:blue'><a href = '../works/paintings/" . $title . "' >$title</a></span>";
        });

        $grid->column('intitule', __('Intitulé'));
        $grid->column('tag', __('Tags'));

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('tag', 'Tags');
        });

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
        $show = new Show(Media::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('tag', __('Tag'));
        $show->field('intitule', __('Intitule'));
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
        $form = new Form(new Media());

        $form->number('lito_id', __('Lito id'));
        $form->number('tableau_id', __('Tableau id'));
        $form->number('sculpture_id', __('Sculpture id'));
        $form->number('demande_id', __('Demande id'));
        $form->image('image', __('Image'));
        $form->tags('tag', __('Tag'));
        $form->text('intitule', __('Intitule'));

        return $form;
    }
}
