<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="#">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('altera-senha') }}">
        @csrf
            <div class="flex justify-content-center">
                <p class="mb-3"><b>Para prosseguir Defina uma nova Senha</b></p>

            </div>
            <!-- Password -->
            <div class="">
                <x-input-label for="password" :value="__('Escolha uma nova senha')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirme a Nova Senha')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                      <x-primary-button class="ml-4">
                    {{ __('Salvar') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
