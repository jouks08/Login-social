<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'text_username' => 'required|email',
            'text_password' => 'required|min:5|max:10',
        ], [
            'text_username.required' => 'O campo e-mail é obrigatório.',
            'text_username.email' => 'Informe um endereço de e-mail válido.',
            'text_password.required' => 'O campo senha é obrigatório.',
            'text_password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'text_password.max' => 'A senha deve ter no máximo :max caracteres.',
        ]);

        $email = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('email', $email)->first();

        if (!$user || !password_verify($password, $user->password)) {
            return redirect()->back()
                ->withInput()
                ->with('login_error', 'E-mail ou senha incorretos!');
        }

        $user->touch(); // Atualiza o campo updated_at

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->name ?? $user->email,
            ]
        ]);

        return redirect()->route('dashboard');
    }

    // Exibe a tela de cadastro (faltava este método)
    public function register()
    {
        return view('formulario_registro');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'text_name' => 'required|min:3|max:100',
            'text_username' => 'required|email|max:255|unique:users,email',
            'text_password' => 'required|min:5|max:10',
            'text_password_repeat' => 'required|same:text_password',
        ], [
            'text_name.required' => 'O nome é obrigatório.',
            'text_name.min' => 'O nome deve ter pelo menos :min caracteres.',
            'text_name.max' => 'O nome deve ter no máximo :max caracteres.',
            'text_username.required' => 'O e-mail é obrigatório.',
            'text_username.email' => 'Informe um e-mail válido.',
            'text_username.unique' => 'Este e-mail já está em uso.',
            'text_password.required' => 'A senha é obrigatória.',
            'text_password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'text_password.max' => 'A senha deve ter no máximo :max caracteres.',
            'text_password_repeat.required' => 'A confirmação de senha é obrigatória.',
            'text_password_repeat.same' => 'As senhas devem ser iguais.',
        ]);

        $user = new User();
        $user->name = $request->input('text_name'); 
        $user->email = $request->input('text_username');
        $user->password = bcrypt($request->input('text_password'));
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->name,
            ]
        ]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('dashboard');
    }

    // manda para o formulario do provider
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // chamado pelo provider no momento em que usa a url de callback
    public function handleProviderCallback($provider)
    {

        $providerUser = Socialite::driver($provider)->user();


        $user = User::firstOrCreate(
            [
                'provider'    => $provider,
                'provider_id' => $providerUser->getId(),
            ],
            [
                'name'  => $providerUser->getName() ?? $providerUser->getNickname(),
                'email' => $providerUser->getEmail(),
            ]
        );
        // Grava a sessão da mesma forma que no login manual
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->name ?? $user->email,
            ]
        ]);

        return redirect('dashboard');
    }
}
