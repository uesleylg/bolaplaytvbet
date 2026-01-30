<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Logs;
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
            'message' => 'Usuário ou senha inválidos!',
            'errors' => $validator->errors(),
        ], 422);
    }

    // 🧠 Monta as credenciais
    $credentials = $request->only('name', 'password');

    // 🚪 Tenta autenticar o usuário
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // 📝 Registrar log no banco usando o model Logs
        Logs::create([
            'usuario' => $user->name,
            'acao' => 'Login realizado com sucesso',
            'tipo' => 'Login',
            'ip' => $request->ip(),
            'dispositivo' => $request->userAgent() ?? '-',
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
    Logs::create([
        'usuario' => $request->input('name'),
        'acao' => 'Tentativa de login falhou (senha incorreta)',
        'tipo' => 'Falha',
        'ip' => $request->ip(),
        'dispositivo' => $request->userAgent() ?? '-',
    ]);

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
    // -------------------------------------------------------------
    // ⭐ 1. Extrair o ID de dentro do código bruto enviado no input
    // Exemplo: PXUXAB1X23QZ → extrai apenas "123"
    // -------------------------------------------------------------
    $referenciaBruta = $request->referencia_id;

    $referenciaExtraida = null;
    if (!empty($referenciaBruta)) {
        preg_match('/(\d+)/', $referenciaBruta, $matches);
        $referenciaExtraida = $matches[1] ?? null;
    }

    // Coloca o ID extraído no request ANTES da validação
    $request->merge([
        'referencia_id' => $referenciaExtraida
    ]);

    // -------------------------------------------------------------
    // ⭐ 2. Validação normal do Laravel (agora com ID limpo)
    // -------------------------------------------------------------
    $validator = Validator::make($request->all(), [
        'name' => [
            'required',
            'string',
            'max:10',
            'unique:users,name',
            'regex:/^[a-z0-9]{1,10}$/',
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
            'regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/',
        ],
        'password' => [
            'required',
            'string',
            'min:6',
        ],

        // agora OK, porque referencia_id já virou um número
        'referencia_id' => 'nullable|integer|exists:users,id',

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

        'referencia_id.integer' => 'Referência inválida.',
        'referencia_id.exists' => 'Referência não encontrada.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 422);
    }

    $validated = $validator->validated();
    $validated['name'] = strtolower($validated['name']);

    // -------------------------------------------------------------
    // ⭐ 3. Criação do usuário
    // -------------------------------------------------------------
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'password' => Hash::make($validated['password']),
        'referencia_id' => $validated['referencia_id'] ?? null,
        'profile_id' => $request->profile_id ?? 1,
    ]);

    $user->carteira()->create([
    'saldo' => 0.00,
]);

    Auth::login($user);
    $request->session()->regenerate();

    Logs::create([
        'usuario' => $user->name,
        'acao' => 'Cadastro realizado com sucesso',
        'tipo' => 'Cadastro',
        'ip' => $request->ip(),
        'dispositivo' => $request->userAgent() ?? '-',
    ]);

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
    try {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'profile_id' => 'required|integer|exists:profiles,id',
            'referencia_id' => 'nullable|integer|exists:users,id',
            'password' => 'nullable|string|min:6',
            'status' => 'nullable|in:Ativo,Bloqueado'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->profile_id = $request->profile_id;
        $user->referencia_id = $request->referencia_id;

        // Atualiza a senha somente se foi enviada
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Atualiza o status apenas se foi enviado
        if ($request->filled('status')) {
            $user->status = $request->status;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuário atualizado com sucesso!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar o usuário: ' . $e->getMessage()
        ], 500);
    }
}
    



public function adminregister(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => [
            'required',
            'string',
            'max:10',
            'unique:users,name',
            'regex:/^[a-z0-9]{1,10}$/', // apenas minúsculas e números
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
            'regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/',
        ],
        'password' => [
            'required',
            'string',
            'min:6',
        ],
        'profile_id' => [
            'required',
            'integer',
            'exists:profiles,id', // garante que o perfil exista na tabela
        ],
    ], [
        'name.required' => 'O nome de usuário é obrigatório.',
        'name.unique' => 'Já existe um usuário com esse nome.',
        'name.max' => 'O nome deve ter no máximo 10 caracteres.',
        'name.regex' => 'Use apenas letras minúsculas e números, sem espaços.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'email.unique' => 'Já existe um usuário com esse e-mail.',
        'phone.regex' => 'Digite um telefone válido (ex: (11) 99999-9999).',
        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
        'profile_id.required' => 'Selecione um perfil.',
        'profile_id.exists' => 'O perfil selecionado é inválido.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 422);
    }

    $validated = $validator->validated();
    $validated['name'] = strtolower($validated['name']);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'password' => Hash::make($validated['password']),
        'referencia_id' => $request->referencia_id ?? null,
        'profile_id' => $validated['profile_id'], // 👈 vem do select agora!
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Cadastro realizado com sucesso! Redirecionando...',
        'redirect' => route('home.index'),
    ]);
}


public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'Usuário não encontrado.']);
    }

    try {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Usuário excluído com sucesso!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Erro ao excluir o usuário.']);
    }
}


}
