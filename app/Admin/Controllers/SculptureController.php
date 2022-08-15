<?php

namespace App\Admin\Controllers;

use App\Models\Media;
use App\Models\Sculpture;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;

class SculptureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sculptures';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Sculpture());

        $admin = new Admin();
        if ($admin->user()->id == 1){
            $grid->disableCreation();
        }
        else
        {
            $grid->model()->where('admin_user_id', '=', $admin->user()->id);
        }
        $grid->column('titre', __('Titre'));
        $grid->column('longueur', __('Longueur'));
        $grid->column('largeur', __('Largeur'));
        $grid->column('hauteur', __('Hauteur'));
        $grid->column('technique_materiaux', __('Technique et materiaux'));
        $grid->column('numero_serie', __('Numéro de serie'));
        $grid->column('annee_creation', __('Année de creation'))->diffForHumans();
        $grid->column('origine_oeuvre', __('Origine d\'œuvre'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    /*protected function detail($id)
    {
        $show = new Show(Sculpture::findOrFail($id));

        $show->field('longueur', __('Longueur'));
        $show->field('largeur', __('Largeur'));
        $show->field('hauteur', __('Hauteur'));
        $show->field('technique_materiaux', __('Technique et materiaux'));
        $show->field('numero_serie', __('Numéro de serie'));
        $show->field('annee_creation', __('Année de creation'));

        $show->media('medias', function ($media) {
           // $media->resource("/admin/works/sculptures/");
            $media->image()->image("", 50);
            $media->tag();
            $media->intitule();
           
        });
        

        return $show;
    }*/

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Sculpture());
        $admin = new Admin();

        $form->hidden('admin_user_id', __('admin_user_id'))->value($admin->user()->id);
        $form->text('titre', __('Titre'))->rules(['required']);
        $form->text('longueur', __('Longueur'))->rules(['required']);
        $form->text('largeur', __('Largeur'))->rules(['required']);
        $form->text('hauteur', __('Hauteur'))->rules(['required']);
        $form->text('technique_materiaux', __('Technique et materiaux'))->rules(['required']);
        $form->text('numero_serie', __('Numéro de serie'))->rules(['required']);
        $form->year('annee_creation', __('Année de creation'))->rules(['required']);
        $form->hidden('origine_oeuvre',__('Origine d\'œuvre'))->value('Saisie');
       
        $form->hasMany('media', function (Form\NestedForm $form) {
            $form->image('image', __('Photo'))->move('/oeuvres')->rules(['required']);
            $form->tags('tag', __('Tag'));
            $form->text('intitule', __('Intitulé'))->rules(['required']);
        });

        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();

        return $form;
    }
}
