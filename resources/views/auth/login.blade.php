<div class="font-sans antialiased">
<x-guest-layout class="login ">
    <div class="container">
    <div class="flex justify-content-center align-items-center">
        <div class="flex-column mr-5">
            <div class="card" style="width: 28rem;">
                <div class="card-body">
                <form  method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control input_login" name="email" id="Email" aria-describedby="emailHelp">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control input_login" id="password" name="password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me">
                        <label class="form-check-label" for="remember_me">Lembrar-me da senha</label>
                    </div>
                    <div class="d-flex justify-content-center mb-4">
                    <button type="submit" class="btn btn-login ">LOGIN</button> <br>
                    </div>

                    <div id="emailHelp" class="d-flex justify-content-end"><a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">esqueceu a senha?</a></div>
                </form>
                </div>
            </div>

        </div>
        <div class="flex-column column-text-login">
            <h1 class="text-login">Olá! :) <br> Seja bem-vindo/a/e <br> a nossa plataforma </h1>
        </div>
    </div>
    </div>
</x-guest-layout>
</div>
