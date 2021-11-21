<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Provider;
use Hash;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\Crypt;



class LoginController extends Controller
{
    public function login(){
       return view ('login');
    }

    public function register(){
        return view ('register');
    }

    public function dashboard(){
        return view ('dashboard');
    }

    public function confirmLogin(Request $request)
    {

        $email = $request['email'];
        $password = $request['password'];
        $passwordConfirm = $request['password_confirm'];

        $user = Users::where('email', request('email'))->count();

        if ($user == 1) {
            Session::flash('messageExists', 'Login já existe!');
            Session::flash('alert-class', 'alert-warning');
            return redirect('/register');
        }

        $message = [
            'required' => 'Campo Obrigatório',
            'same' => 'As senhas precisam serem iguais!',
            'email' => 'Digite um e-mail válido!',
            'password.min' => 'A senha deve conter no mínimo 6 dígitos',
        ];
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns|unique:users,email|required',
            'password' => 'required|min:6|max:30|same:password_confirm',
            'password_confirm' => 'required|same:password|min:6'
        ], $message);


        $user = new Users;

        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make((request('password')));
        $user->remember_token = Str::random(10);
        $user->save();

        Session::flash('message', 'Usuário adicionado com sucesso!');
        Session::flash('alert-class', 'alert-success');

        return redirect('/register');
        
    }

    public function logar(Request $request){
        
        $email = $request['email'];
        $password = $request['password'];

        $user = Users::where('email', $email)
                    ->first(); 

                    if ($user) // encontrou o usuário
                    {

                        if(password_verify($password, $user->password)) {
                           $item = Provider::all();
        
                            return view('/dashboard', compact('item'));
                        }
                            //senha inválida...
                            return back()->with('failed', 'Usuário ou Senha incorretos');
                    }

    }

    public function validate_cnpj(Request $request){
        $cnpj = $request['cnpj'];

        $url = "https://www.receitaws.com.br/v1/cnpj/" . $cnpj;

       

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        $resp = json_decode($resp);


        if(!empty($resp->cnpj)){
            $fcd = new Provider;
            
            $fcd->nome = $resp->nome;
            $fcd->cnpj = $resp->cnpj;
            $fcd->atividade_principal = $resp->atividade_principal[0]->text;

            $fcd->save();

            $item = Provider::all();
             return view('/dashboard', compact('item'));
        }

              

    }

    
}
