<?php

namespace App\Livewire\Admin;

use App\Repository\UserRepository;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $username = "";
    public string $password = "";

    public function __construct(
        protected UserRepository $userRepository = new UserRepository()
    ) {
    }

    public function auth(): mixed
    {
        if (is_null($this->userRepository->getUserByUsername($this->username)))
            return redirect(route('login'))->with('error', "User tdk ada");
        if (auth()->attempt([
            'username' => $this->username,
            'password' => $this->password
        ])) return redirect(route('dashboard'))->with('status', "Berhasil login");
        return redirect(route('login'))->with('error', "Gagal Login");
    }

    #[Layout('layouts.admin.base')]
    public function render(): View
    {
        return view('livewire.admin.login');
    }
}
