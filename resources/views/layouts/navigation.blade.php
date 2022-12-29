<style>
    .search-box {
        width: 45rem;
        text-align:center;
    }

    .search-box::placeholder {
        text-align: center;
    }
</style>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center pt-4">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

            </div>


            <div class="flex justify-center lex-grow-1">
                <x-text-input id="search" class="block my-2 search-box" type="text" name="search" placeholder=" Pesquisar por artigos, podcats, conteúdo da base de conhecimento, livros ou cursos" />



            </div>
            <div class="d-flex mt-3">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fa-regular pointer fa-bell mr-3 notificacao" onclick="ver()"></i>
                        <span id="num_notificacao" class="badge bg-danger rounded-pill numeral-notificacao"></span>
                    </x-slot>

                    <x-slot name="content">
                        <div id="notificacao" class="bg-grey">

                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium" style="background: none">
                            <div>

                                @if(auth()->user()->image != 'none' )
                                    @php
                                        $image = auth()->user()->image;
                                    @endphp
                                    <img src="{{asset("storage/user/{$image}")}}" width="50rem" height="50rem">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 15 15" fill="none">
                                        <path d="M5 5.5C5 4.11929 6.11929 3 7.5 3C8.88071 3 10 4.11929 10 5.5C10 6.88071 8.88071 8 7.5 8C6.11929 8 5 6.88071 5 5.5Z" fill="black"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 0C3.35786 0 0 3.35786 0 7.5C0 11.6421 3.35786 15 7.5 15C11.6421 15 15 11.6421 15 7.5C15 3.35786 11.6421 0 7.5 0ZM1 7.5C1 3.91015 3.91015 1 7.5 1C11.0899 1 14 3.91015 14 7.5C14 9.34956 13.2275 11.0187 11.9875 12.2024C11.8365 10.4086 10.3328 9 8.5 9H6.5C4.66724 9 3.16345 10.4086 3.01247 12.2024C1.77251 11.0187 1 9.34956 1 7.5Z" fill="black"/>
                                    </svg>
                                @endif
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    $(document).ready(()=>{
        $.ajax({
            url: "{{ URL::to('/notificacao') }}/"+{{auth()->user()->id}},
            success: function(data){
                var notificacao = '';
                if(data.length > 0) {
                    $('#num_notificacao').html(data.length)
                }
                data.forEach((item)=>{
                    notificacao += '<div class="card mt-2 p-2">'+ item.notificacao + '</div>';
                })
                $('#notificacao').html(notificacao)
            }
        });
    });

    function ver(){
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/notificacao/ver') }}",
            data:  {'user_id': {{auth()->user()->id}}, '_token': '{{ csrf_token() }}'},
            success: function(){
                $('#num_notificacao').remove();            }
        });
    }


</script>
