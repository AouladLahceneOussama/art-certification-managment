<?php

namespace App\Admin\Controllers;

use App\Models\Administrator;
use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Illuminate\Support\Facades\Hash;
class AuthController extends BaseAuthController
{
    public function postLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);

        $artist = Administrator::where('username', '=', $credentials['username'])->first();
        if (($artist->isActif == 1 && $artist->abonnement->fin_abonnement > date('Y-m-d')) || $artist->id ==1) {
            if ($this->guard()->attempt($credentials, $remember)) {
                return $this->sendLoginResponse($request);
            }
            return back()->withInput()->withErrors([
                $this->username() => $this->getFailedLoginMessage(),
            ]);
        }
        else{
            Administrator::where('username', '=', $credentials['username'])->update(['isActif' => '0']);
            return redirect('admin\auth\login');
        }
    }

    protected function settingForm()
    {
        $class = config('admin.database.users_model');

        $form = new Form(new $class());

        $form->text('LastName', __('Nom'))->rules('required');
        $form->text('FirstName', __('Prénom'))->rules('required');
        $form->display('username', __('Alias'))->rules('required');
        $form->image('avatar', __('Photo de Profil'))->rules('required');
        
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
            'particulier' => 'particulier',
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

        $form->text('biography', __('Biographie'))->rules('required');

        
        $form->image('avatar', __('Photo de Profil'))->crop(500,500)->move('/profiles/profile');
        $form->image('coverture_photo', __('Photo de coverture'))->move('/profiles/background');
      

       
        $form->setAction(admin_url('auth/setting'));

        $form->ignore(['password_confirmation']);

        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));
            return redirect(admin_url('auth/setting'));
        });


        return $form;
    }
}
