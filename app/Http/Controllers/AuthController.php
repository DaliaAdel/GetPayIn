<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    protected $repo;

    public function __construct(AuthInterface $repo)
    {
        $this->repo = $repo;
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        return response()->json($this->repo->register($validated));
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        return response()->json($this->repo->login($validated));
    }

    public function profile()
    {
        return response()->json($this->repo->profile());
    }
}
