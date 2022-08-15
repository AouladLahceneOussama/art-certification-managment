<?php

namespace App\Admin\Controllers;

use App\Models\Lito;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;

class LitoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */ 
    protected $title = 'Litographies';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lito());
        $admin = new Admin();
        if ($admin->user()->id == 1){
            $grid->disableCreation();
        }
        else
        {
            $grid->model()->where('admin_user_id', '=', $admin->user()->id);
        }
        $grid->column('titre', __('Titre de l\'œuvre'));
        $grid->column('annee_creation', __('Année de creation'));
        $grid->column('longueur', __('Longueur'));
        $grid->column('largeur', __('Largeur'));
        $grid->column('technique_materiaux', __('Technique et materiaux'));
        $grid->column('support', __('Support'));
        $grid->column('Emplacement_signature', __('Emplacement de la signature'));
        $grid->column('numero_serie', __('Numero de serie'));
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
        $show = new Show(Lito::findOrFail($id));

        $show->field('titre', __('Titre de l\'œuvre'));
        $show->field('annee_creation', __('Année de creation'));
        $show->field('longueur', __('Longueur'));
        $show->field('largeur', __('Largeur'));
        $show->field('technique_materiaux', __('Technique et materiaux'));
        $show->field('support', __('Support'));
        $show->field('Emplacement_signature', __('Emplacement de la signature'));
        $show->field('numero_serie', __('Numero de serie'));
        return $show;
    }*/

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Lito());
        $admin = new Admin();

        $form->hidden('admin_user_id', __('admin_user_id'))->value($admin->user()->id);
        $form->text('titre', __('Titre de l\'œuvre'))->rules(['required']);
        $form->year('annee_creation', __('Année de creation'))->rules(['required']);
        $form->text('longueur', __('Longueur'))->rules(['required']);
        $form->text('largeur', __('Largeur'))->rules(['required']);
        $form->text('technique_materiaux', __('Technique et materiaux'))->rules(['required']);
        $form->text('support', __('Support'))->rules(['required']);
        $form->text('Emplacement_signature', __('Emplacement de la signature'))->rules(['required']);
        $form->text('numero_serie', __('Numero de serie'))->rules(['required']);
        $form->hidden('origine_oeuvre',__('Origine d\'œuvre'))->value('Saisie');

        /*if ($form->isCreating() || $admin->user()->id == 1) {
            $form->text('code_certificat', __('Code de Certificat'))

                ->default(uniqid())
                ->help('si votre œuvre n\'est pas encore certifiée evitez de changer ce code')
                ->creationRules(['required', "unique:tableaus,code_certificat"]);
        } else {
            $form->text('code_certificat', __('Code de Certificat'))
                ->disable();
            $form->ignore('code_certificat');
        }*/
        $form->hasMany('media', function (Form\NestedForm $form) {
            $form->image('image', __('Photo'))->move('/oeuvres')->rules(['required']);
            $form->text('tag', __('Tag'))->rules(['required']);
            $form->text('intitule', __('Intitulé'))->rules(['required']);
        });

        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        return $form;
    }
}
