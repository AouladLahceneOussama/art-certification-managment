<?php

namespace App\Admin\Controllers;

use App\Models\Tableau;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;
use App\Models\Media;

class TableauController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tableaux';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tableau());

        $admin = new Admin();
        if ($admin->user()->id == 1){
            $grid->disableCreation();
        }
        else
        {
            $grid->model()->where('admin_user_id', '=', $admin->user()->id);
        }

        $grid->column('id', __('Id'));
        $grid->column('titre', __('Titre de l\'oeuvre'));
        $grid->column('annee_creation', __('Année de création'));
        $grid->column('Emplacement_signature', __('Emplacement de signature utilisé'));
        $grid->column('support', __('Support'));
        $grid->column('technique_materiaux', __('Technique et materiaux'));
        $grid->column('longueur', __('longueur'));
        $grid->column('largeur', __('largeur'));
        $grid->column('origine_oeuvre', __('Origine d\'oeuvre'));


        // $grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Tableau::findOrFail($id));



        $show->field('id', __('Id'));
        $show->field('titre', __('Titre de l\'oeuvre'));
        $show->field('annee_creation', __('Année de création'));
        $show->field('Emplacement_signature', __('Emplacement de signature'));
        $show->field('support', __('Support'));
        $show->field('technique_materiaux', __('Technique et materiaux utilisé'));
        $show->field('longueur', __('longueur'));
        $show->field('largeur', __('largeur'));
        $show->field('origine_oeuvre',__('Origine d\'oeuvre'));

        $show->media('medias', function ($media) {
            $media->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('tag', 'Tag');
            });
            $media->resource('/admin/works/paintings/');
            $media->image()->image("", 50);
            $media->tag();
            $media->intitule();
        });
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Tableau());

        $admin = new Admin();

        $form->hidden('admin_user_id', __('admin_user_id'))->value($admin->user()->id);
        $form->text('titre', __('Titre de l\'oeuvre'))->creationRules(['required']);
        $form->year('annee_creation', __('Année de création'))->creationRules(['required']);
        $form->text('Emplacement_signature', __('Emplacement de signature'))->creationRules(['required']);
        $form->text('support', __('Support'))->creationRules(['required']);
        $form->text('technique_materiaux', __('Techniques et matériel utilisé'))->creationRules(['required']);
        $form->text('longueur', __('longueur'))->creationRules(['required']);
        $form->text('largeur', __('largeur'))->creationRules(['required']);
        $form->hidden('origine_oeuvre',__('Origine d\'oeuvre'))->value('Saisie');


        $form->hasMany('media', function (Form\NestedForm $form) {
            $form->image('image' ,__('Photo'))->move('oeuvres')->creationRules(['required']);
            $form->tags('tag',__('Tag'));
            $form->text('intitule',__('Intitulé'))->creationRules(['required']);
        });

        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        return $form;
    }
}
