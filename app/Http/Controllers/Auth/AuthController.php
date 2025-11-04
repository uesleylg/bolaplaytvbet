<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    
    public function showLogin()
    {
        return view('index');
    }

public function login(Request $request)
{
    // 🔍 Validação dos dados recebidos
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Dados inválidos.',
            'errors' => $validator->errors(),
        ], 422);
    }

    // 🧠 Monta as credenciais
    $credentials = $request->only('name', 'password');

    // 🚪 Tenta autenticar o usuário
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // 🧾 Log de acesso
        Log::info('Login realizado', [
            'user_id' => $user->id,
            'name' => $user->name,
            'profile' => $user->profile,
            'ip' => $request->ip(),
        ]);

        // 🔐 Redirecionamento conforme o perfil
        $redirect = match ($user->profile) {
            'admin' => route('admin.dashboard'),
            'reseller' => route('reseller.dashboard'),
            default => route('home.index'),
        };

        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso! Redirecionando...',
            'redirect' => $redirect,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'profile' => $user->profile,
            ],
        ]);
    }

    // 🚫 Falha na autenticação
    return response()->json([
        'success' => false,
        'message' => 'Usuário ou senha inválidos.',
    ], 401);
}



    public function showRegister()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => [
            'required',
            'string',
            'max:10',
            'unique:users,name',
            'regex:/^[a-z0-9]{1,10}$/', // apenas letras minúsculas e números, sem espaço
        ],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email',
        ],
        'phone' => [
            'nullable',
            'string',
            // Formato brasileiro: (XX) XXXX-XXXX ou (XX) XXXXX-XXXX
            'regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/',
        ],
        'password' => [
            'required',
            'string',
            'min:6',
         
        ],
    ], [
        'name.required' => 'O nome de usuário é obrigatório.',
        'name.unique' => 'Já existe um usuário com esse nome.',
        'name.max' => 'O nome deve ter no máximo 10 caracteres.',
        'name.regex' => 'O nome deve conter apenas letras minúsculas e números, sem espaços ou símbolos.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'email.unique' => 'Já existe um usuário com esse e-mail.',
        'phone.regex' => 'Digite um telefone válido com a quantidade correta de números.',
        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres.',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(), // só retorna a primeira mensagem
        ], 422);
    }

    $validated = $validator->validated();
    $validated['name'] = strtolower($validated['name']); // força minúsculas

$user = User::create([
    'name' => $validated['name'],
    'email' => $validated['email'],
    'phone' => $validated['phone'] ?? null,
    'password' => Hash::make($validated['password']),
    'referencia_id' => $request->referencia_id ?? null,
    'profile_id' => $request->profile_id ?? 1, // 👈 define client (ID 1) como padrão
]);

    Auth::login($user);
    $request->session()->regenerate();

    return response()->json([
        'success' => true,
        'message' => 'Cadastro realizado com sucesso! Redirecionando...',
        'redirect' => route('home.index'),
    ]);
}



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }

  public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'profile_id' => 'required|exists:profiles,id',
            'referencia_id' => 'nullable|exists:users,id',
            'status' => 'required|in:ativo,bloqueado',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->profile_id = $request->profile_id;
        $user->referencia_id = $request->referencia_id;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }
    



    public function adminregister(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => [
            'required',
            'string',
            'max:10',
            'unique:users,name',
            'regex:/^[a-z0-9]{1,10}$/', // apenas letras minúsculas e números, sem espaço
        ],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email',
        ],
        'phone' => [
            'nullable',
            'string',
            // Formato brasileiro: (XX) XXXX-XXXX ou (XX) XXXXX-XXXX
            'regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/',
        ],
        'password' => [
            'required',
            'string',
            'min:6',
         
        ],
    ], [
        'name.required' => 'O nome de usuário é obrigatório.',
        'name.unique' => 'Já existe um usuário com esse nome.',
        'name.max' => 'O nome deve ter no máximo 10 caracteres.',
        'name.regex' => 'O nome deve conter apenas letras minúsculas e números, sem espaços ou símbolos.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'email.unique' => 'Já existe um usuário com esse e-mail.',
        'phone.regex' => 'Digite um telefone válido com a quantidade correta de números.',
        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres.',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(), // só retorna a primeira mensagem
        ], 422);
    }

    $validated = $validator->validated();
    $validated['name'] = strtolower($validated['name']); // força minúsculas

$user = User::create([
    'name' => $validated['name'],
    'email' => $validated['email'],
    'phone' => $validated['phone'] ?? null,
    'password' => Hash::make($validated['password']),
    'referencia_id' => $request->referencia_id ?? null,
    'profile_id' => $request->profile_id ?? 1, // 👈 define client (ID 1) como padrão
]);

    Auth::login($user);
    $request->session()->regenerate();

    return response()->json([
        'success' => true,
        'message' => 'Cadastro realizado com sucesso! Redirecionando...',
        'redirect' => route('home.index'),
    ]);
}

}
