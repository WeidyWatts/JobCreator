<x-app-layout>
    <div class="flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="card-header">Minha Conta </h1>
                <div class="card-body">
                    <div class="container">
                        <form method="POST" action="{{route('usuario.update',auth()->user()->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mt-3 mb-5 d-flex justify-content-center">
                                @if(auth()->user()->image != 'none' )
                                    @php
                                    $image = auth()->user()->image;
                                    @endphp
                                    <img src="{{asset("storage/user/{$image}")}}" width="100rem" height="100rem">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="150px" height="150px" viewBox="0 0 15 15" fill="none">
                                        <path d="M5 5.5C5 4.11929 6.11929 3 7.5 3C8.88071 3 10 4.11929 10 5.5C10 6.88071 8.88071 8 7.5 8C6.11929 8 5 6.88071 5 5.5Z" fill="black"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 0C3.35786 0 0 3.35786 0 7.5C0 11.6421 3.35786 15 7.5 15C11.6421 15 15 11.6421 15 7.5C15 3.35786 11.6421 0 7.5 0ZM1 7.5C1 3.91015 3.91015 1 7.5 1C11.0899 1 14 3.91015 14 7.5C14 9.34956 13.2275 11.0187 11.9875 12.2024C11.8365 10.4086 10.3328 9 8.5 9H6.5C4.66724 9 3.16345 10.4086 3.01247 12.2024C1.77251 11.0187 1 9.34956 1 7.5Z" fill="black"/>
                                    </svg>
                                @endif
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="imagem" class="form-label">Atualizar Imagem</label>
                                <input type="file" name="image" class="form-control" id="Logo">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <x-text-input id="name" type="text" name="name" value="{{Auth::user()->name}}" required />
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
