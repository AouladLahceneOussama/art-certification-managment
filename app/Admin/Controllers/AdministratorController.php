<?php

namespace App\Admin\Controllers;

use App\Models\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdministratorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Admin';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Administrator());

        $grid->column('id', ('Id'))->sortable();
        $grid->column('roles', trans('admin.roles'))->pluck('name')->label();
        $grid->column('avatar', __('Photo de Profil'))->image("/", 50);
        $grid->column('LastName', __('Nom'));
        $grid->column('FirstName', __('Prénom'));
        $grid->column('username', __('Alias'));
        $grid->column('phone', __('Téléphone'));
        $grid->column('email', __('Email'));
        $grid->column('birth', __('Date de Naissance'));
        $grid->column('pays', __('Pays'));
        $grid->column('occupation', __('Occupation'));
        $grid->column('specialities', __('Spécialité'))->implode(', ');


        $grid->column('biography', __('Biographie'));
        $grid->column('isActif', __('Compte Activé'))->switch(); //switch($states)

        $grid->column('created_at', __('Created at'))->diffForHumans()->hide();
        $grid->column('updated_at', __('Updated at'))->diffForHumans()->hide();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() == 1) {
                $actions->disableDelete();
            }
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
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
        $show = new Show(Administrator::findOrFail($id));

        $show->field('id', ('Id'));
        $show->field('avatar', __('Avatar'))->image();
        $show->field('coverture_photo', __('Image de coverture'))->image();
        $show->field('username', __('Alias'));
        $show->field('FirstName', ('Nom'));
        $show->field('LastName', __('Prenom'));
        $show->field('pays', __('Pays'));
        $show->field('birth', __('Naissance'));
        $show->field('biography', __('Biographie'));
        $show->field('occupation', __('Occupation'));
        $show->field('specialities')->as(function ($specialities) {
            return implode(',',$specialities);
        });
        $show->divider();
        $show->field('created_at', __('Created at'))->diffForHumans();
        $show->field('updated_at', __('Updated at'))->diffForHumans();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $userModel = config('admin.database.users_model');
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');

        $form = new Form(new $userModel());
        // $form = new Form(new Administrator());

        $form->text('LastName', __('Nom'))->rules('required');
        $form->text('FirstName', __('Prénom'))->rules('required');
        $form->text('username', __('Alias'))->rules('required');
        $form->image('avatar', __('Photo de Profil'))->crop(500,500)->move('/profiles/profile');
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });
        $form->ignore(['password_confirmation']);

        $form->text('phone', __('Téléphone'))->rules('required');
        $form->text('email', __('Email'))->rules('required');
        $form->date('birth', __('Date de Naissance'))->rules('required');
        $form->text('pays', __('Pays'))->rules('required');
        
        $form->select('occupation', __('Occupation'))->options([
            'artiste' => 'Artiste',
            'marchand d\'art' =>  'Marchand d\'art',
            'collectionneur' =>'Collectionneur',
            'particulier' => 'Particulier',
            'entreprise' =>'Entreprise',
            'gallerie'=>'Gallerie'
        ])->rules('required');
        
        $form->text('autre_nom',__('Nom de l\'entreprise(Gallerie) '));

        $form->multipleSelect('specialities', __('Spécialité'))->options([
            'peinture' => 'Peinture',
            'litographie' => 'Litographie',
            'sculpture' => 'Sculpture',
            'photographie' => 'Photographie'
        ]);

        $form->text('biography', __('Biographie'));
        $form->image('coverture_photo', __('Photo de coverture'))->move('/profiles/background');
        if ($form->isEditing())
            $form->switch('isActif', __('Compte Activé'));

        $form->multipleSelect('roles', trans('admin.roles'))->options($roleModel::all()->pluck('name', 'id'));
        $form->multipleSelect('permissions', trans('admin.permissions'))->options($permissionModel::all()->pluck('name', 'id'));
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });
        
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();

        return $form;
    }
}
