<?php

namespace App\Admin\Controllers;

use App\Models\Abonnement;
use App\Models\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Collection;

class AbonnementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Abonnement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Abonnement());

        $grid->column('id', __('Id'));
        $grid->column(__('artist'))->display(function() {
            $username = Administrator::find($this->admin_user_id)->username;
            return '<a href="auth/users/'.$this->admin_user_id.'">'.$username.'</a>';
        });
        $grid->column('plan', __('Plan'));
        $grid->column('method_paiement', __('Method paiement'));
        $grid->column('frais_plan', __('Frais plan'));
        $grid->column('debut_abonnement', __('Debut abonnement'))->diffForHumans();
        $grid->column('fin_abonnement', __('Fin abonnement'))->diffForHumans();


        $grid->model()->collection(function(Collection $collection) { 

            foreach ($collection as $item) {      
                if($item->debut_abonnement == null || $item->fin_abonnement == null ) {
                    $item->debut_abonnement = null; 
                    $item->fin_abonnement = null;  
                }
                      
            }

            return $collection;
        });

        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->filter(function($filter){

            $filter->disableIdFilter();

            $filter->equal('plan')
            ->select([
                'mois' => 'mois',
                'inditermine' => 'inditermine',
                'annee' => 'annee'
            ]);

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
        $show = new Show(Abonnement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('admin_user_id', __('Admin user id'));
        $show->field('plan', __('Plan'));
        $show->field('method_paiement', __('Method paiement'));
        $show->field('frais_plan', __('Frais plan'));
        $show->field('debut_abonnement', __('Debut abonnement'));
        $show->field('fin_abonnement', __('Fin abonnement'));
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
        $form = new Form(new Abonnement());

        $form->number('admin_user_id', __('Admin user id'));
        $form->text('plan', __('Plan'));
        $form->text('method_paiement', __('Method paiement'));
        $form->number('frais_plan', __('Frais plan'));
        $form->date('debut_abonnement', __('Debut abonnement'))->default(date('Y-m-d'));
        $form->date('fin_abonnement', __('Fin abonnement'))->default(date('Y-m-d'));

        return $form;
    }
}
