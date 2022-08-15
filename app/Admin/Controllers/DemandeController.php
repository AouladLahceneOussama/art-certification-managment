<?php

namespace App\Admin\Controllers;

use App\Models\Certificat;
use App\Models\Demande;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Admin;
use App\Models\Media;

class DemandeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Demandes de Certificat';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Demande());
        $admin = new Admin();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('statut', 'Statut');
        });

        if ($admin->user()->id != 1) {

            $grid->model()->where([
                ['nom_artist', '=', $admin->user()->username],
            ]);
        }

        $grid->column('id', __('Id'));
        $grid->column('nom', __('Nom'));
        $grid->column('prenom', __('Prénom'));
        $grid->column('telephone', __('Téléphone'));
        $grid->column('email', __('Email'));

        if ($admin->user()->id == 1) {
            $grid->column('nom_artist', __('Nom d\'artiste'));
        }

        $grid->column('titre_oeuvre', __('Titre de l\'œuvre'));
        $grid->column('type_oeuvre', __('Type de l\'œuvre'));
        $grid->column('longueur', __('Longueur'));
        $grid->column('largeur', __('Largeur'));
        $grid->column('hauteur', __('Hauteur'));
        $grid->column('technique_materiaux', __('Technique et materiaux'));
        $grid->column('support', __('Support'));
        $grid->column('annee_creation', __('Année de creation'));
        $grid->column('Emplacement_signature', __('Emplacement de la signature'));
        $grid->column('numero_serie', __('Numéro de serie'));

        $grid->column('statut', __('Statut'))->display(function ($title, $column) {
            if ($this->statut != "En attente")
                return $this->statut;
            return $column->editable('select', ['En attente' => __('En attente'), 'Acceptée' => __('Acceptée'), 'Refusée' => __('Refusée')]);
        });

        $grid->column('created_at', __('Created at'))->diffForHumans()->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

      
        
    
        $grid->column(__('pdf'))->display(function () {

            if($this->statut == 'Acceptée'){
                $id_certificat = "";
                if($this->type_oeuvre == "tableau"){
                    
                    $id_oeuvre = Media::where('demande_id','=',$this->id)->pluck('tableau_id')->first();
                    $id_certificat = Certificat::where('tableau_id',"=",$id_oeuvre)->pluck('id')->first();

                }
                if($this->type_oeuvre == "sculpture"){
                    $id_oeuvre = Media::where('demande_id','=',$this->id)->pluck('sculpture_id')->first();

                    $id_certificat = Certificat::where('sculpture_id',"=",$id_oeuvre)->pluck('id')->first();

                }
                if($this->type_oeuvre == "lito"){
                    $id_oeuvre = Media::where('demande_id','=',$this->id)->pluck('lito_id')->first();

                    $id_certificat = Certificat::where('lito_id',"=",$id_oeuvre)->pluck('id')->first();

                }

                return "<span style='color:blue'><a href = 'pdf/".$this->type_oeuvre."-".$id_oeuvre."/".$id_certificat."' target ='_blank' > get pdf</a></span>";
            }
            else
                return "";
        });
        
        
        

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->disableCreateButton();
        return $grid;
    }


    protected function form()
    {
        
        $form = new Form(new Demande());
        $admin = new Admin();

        if ($form->isEditing()) {
            $form->text('nom', __('Nom'))->disable();
            $form->text('prenom', __('Prénom'))->disable();
            $form->text('telephone', __('Téléphone'))->disable();
            $form->email('email', __('Email'))->disable();
            $form->divider();
            if($admin->user()->id == 1){
                $form->text('nom_artist', __('Nom de l\'artiste'))->disable();
            }
            $form->text('titre_oeuvre', __('Titre de l\'œuvre'))->disable();
            $form->text('type_oeuvre', __('Type de l\'œuvre'))->disable();
            $form->text('longueur', __('Longueur'))->disable();
            $form->text('largeur', __('Largeur'))->disable();
            $form->text('hauteur', __('Hauteur'))->disable();
            $form->text('technique_materiaux', __('Technique et materiaux'))->disable();
            $form->text('support', __('Support'))->disable();
            $form->year('annee_creation', __('Année de creation'))->default(date('Y'))->disable();
            $form->text('Emplacement_signature', __('Emplacement de la signature'))->disable();
            $form->text('numero_serie', __('Numero serie'))->disable();
            // $form->ignore(
            //     "nom",
            //     "prenom",
            //     "email",
            //     "telephone",
            //     "nom_artist",
            //     "titre_oeuvre",
            //     "type_oeuvre",
            //     "longueur",
            //     "largeur",
            //     "hauteur",
            //     "technique_materiaux",
            //     "support",
            //     "annee_creation",
            //     "Emplacement_signature",
            //     "numero_serie",
            // );
            /* $form->text('code_certificat', __('Code de Certificat'))
                ->disable();
            $form->ignore('code_certificat');*/

            $form->select('statut', __('Statut'))->options([
                'En attente' => __('En attente'),
                'Acceptée' => __('Acceptée'),
                'Refusée' => __('Refusée'),
            ]);
        }
        if (!is_null(request()->demand))
            $medias = Media::where('demande_id', '=', request()->demand)->get();

        // $output = '
        // <div class="fluid-container">
        
        //   <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Images de l\'œuvre</h1>
        
        //   <hr class="mt-2 mb-5">
        
        //   <div class="row text-center text-lg-left">';
        // foreach ($medias as $m) {
        //     $output .= '  
        //    <div class="col-lg-3 col-md-4 col-6">
        //         <div class="d-block mb-4 h-100">
        //             <img class="img-fluid img-thumbnail" src="' . $m->image . '" alt="' . $m->intitule . '">
        //             <p>Intitulé :' . $m->intitule . '</p>
        //             <p>Tag :' . $m->tag . '</p>
        //         </div>
        //    </div>
        //   ';
        // }
        // $output .= ' </div>
        //   </div>
        //  ';

        $output = '
            <h1 class="font-weight-light text-center text-lg-left">Images de l\'œuvre</h1>
            <div class="wrapper-gallerie">
                <div class="gallery">';
                    foreach ($medias as $m) {
                            $output .= '<div class="image"><span><img class="imageSrc" src="'.$m->image .'" alt="">'.$m->intitule.'</span></div>';
                    }
        $output .= '
                </div>
            </div>
            <div class="preview-box">
                <div class="details">
                    <span class="title">Image <p class="current-img"></p> of <p class="total-img"></p></span>
                    <span class="icon fas fa-times"></span>
                </div>
                <div class="image-box">
                    <div class="slide prev"><i class="fas fa-angle-left"></i></div>
                    <div class="slide next"><i class="fas fa-angle-right"></i></div>
                    <img class="imageToShow" src="" alt="">
                </div>
            </div>
            <div class="shadow"></div>';
        $form->html($output);



        //'<img src="/storage/'.$m->image.'"/>'
        //dd(request()->route()->parameters['demand']);
        //$media = new Media();

        // dump($form->model()->id);
        //dd($media->model->id);
        //$form->html($media->text('tag'));


        // $form->hasMany('media', function (Form\NestedForm $form) {
        //     $form->image('image', __('Photo'))->rules(['required']);
        //     $form->text('tag', __('Tag'))->rules(['required']);
        //     $form->text('intitule', __('Intitulé'))->rules(['required']);
        //     $form->disableNewButton();
        // });

        $form->tools(function (Form\Tools $tools) {
            
            $admin = new Admin();
            
            if($admin->user()->id == 1){
                $tools->disableDelete(); 
            }

            $tools->disableView();
            $nextPage = request()->demand + 1;
            $demandeExist = Demande::find($nextPage);
            
            if($demandeExist)
                $tools->add('<a class="btn btn-sm btn-primary" href="/admin/demands/'.$nextPage.'/edit">'.__('Suivant').'</a>');

        });
        
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();



        return $form;
    }
}
