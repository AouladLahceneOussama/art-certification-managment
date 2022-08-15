<?php

namespace App\Admin\Controllers;

use App\Models\RechercheParCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class RchercheParCodeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Recherches par code';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    { 
        $grid = new Grid(new RechercheParCode());

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('code_certificat', 'Code certificat');
        });

        $grid->column('nom', __('Nom'));
        $grid->column('prenom', __('Prénom'));
        $grid->column('telephone', __('Téléphone'));
        $grid->column('email', __('Email'));
        if(Admin::user()->id == 1){
            $grid->column('id_artist', __('ID de l\'artist'))->display(function ($title) {
                return "<span style='color:blue'><a href = 'auth/users/".$title."' >$title</a></span>";
            });
        }
        $grid->column('code_certificat', __('Code certificat'));
        $grid->column('created_at', __('Date de création'))->diffForHumans();
        $grid->disableActions();
        $grid->disableCreateButton();

        return $grid;
    }

  
}
