<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => [
                'required',
                'regex:/^\+7\d{10}$/',
                'unique:users,phone',
            ],
            'password' => 'required|string|min:6|confirmed',
        ],[
            'phone.regex' => 'Введите номер телефона в международном формате, например: +998901234567',
            'phone.unique' => 'Этот номер уже зарегистрирован.',
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'is_admin' => 0,
        ]);
        // Ссылка на подтверждение
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        // Отправка письма
        Mail::raw("Подтвердите ваш email: $verificationUrl", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Подтверждение Email');
        });
        Auth::login($user);
        return redirect('/dashboard')->with('success', 'На вашу почту отправлена ссылка для подтверждения.');
    }
    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if (!hash_equals((string) $hash, sha1($user->email))) {
            abort(403, 'Недопустимая ссылка.');
        }
        $user->email_verified_at = now();
        $user->save();
        return redirect('/dashboard')->with('success', 'Email успешно подтверждён!');
    }
    public function resendVerificationEmail(Request $request)
    {
        $user = $request->user();
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        Mail::raw("Подтвердите ваш email: $verificationUrl", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Подтверждение Email');
        });
        return back()->with('success', 'Ссылка для подтверждения отправлена повторно.');
    }

}
