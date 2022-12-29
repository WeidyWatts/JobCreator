<style>
    .action {
        cursor: pointer;
    }
</style>
<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator header header-creator-creator"><b>Links</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        @if(auth()->user()->user_type != 3)
                                            <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarlink">Adicionar Novo</button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if(isset($links))
                                @foreach($links as $link)
                                    <div class="item mb-4">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="{{$link->link}}" class="action" target="_blank"><b>{{$link->titulo}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2 class="orange-color">{{$link->descricao}}</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="mr-2 orange-color" id="link{{$link->id}}" onclick="favoritar({{$link->id}})">@if(in_array($link->id, $favoritos))<i class="fa fa-star"></i> salvo @else<i class="fa-regular fa-star"></i> salvar @endif</a>
                                                @if(auth()->user()->user_type != 3)

                                                <a class="orange-color mr-2" data-bs-toggle="modal" data-bs-target="#editarlink{{$link->id}}"> <i class="fa fa-check"></i> editar </a>

                                                <a class="orange-color" data-bs-toggle="modal" data-bs-target="#deletarlink{{$link->id}}"><i class="fa fa-trash"></i> excluir </a>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        </a>
                                        @endforeach
                                        {{ $links->links() }}
                                        @endif
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>

<div class="modal fade" id="Adicionarlink" tabindex="-1" aria-labelledby="AdicionarlinkLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-creator header header-creator-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('link.store')}}" method="POST">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="titulo"  class="form-label">Titulo</label>
                        <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="link"  class="form-label">Link </label>
                        <x-text-input id="link" style="width: 100%" type="text" name="link" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="descricao"  class="form-label">Descrição </label>
                        <x-text-input id="descricao" style="width: 100%" type="text" name="descricao" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn salvar">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@if(isset($links))
    @foreach($links as $link)
        <div class="modal fade" id="editarlink{{$link->id}}" tabindex="-1" aria-labelledby="editarlinkLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator header header-creator-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('link.update',$link->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo</label>
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$link->titulo}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="link"  class="form-label">Link </label>
                                <x-text-input id="link" style="width: 100%" type="text" name="link" value="{{$link->link}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="descricao"  class="form-label">Descricao </label>
                                <x-text-input id="descricao" style="width: 100%" type="text" name="descricao" value="{{$link->descricao}}" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn salvar">Salvar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif


@if(isset($links))
    @foreach($links as $link)
        <div class="modal fade" id="deletarlink{{$link->id}}" tabindex="-1" aria-labelledby="deletarlinkLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator header header-creator-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('link.destroy',$link->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$link->titulo}} ?</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn salvar">Deletar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @endforeach
@endif

<script>

    function favoritar(id){
        console.log($('#link'+id).html())
        if($('#link'+id).html() != '<i class="fa fa-star"></i> salvo '){

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/favoritos') }}",
                data:  {'tipo': 'link', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#link'+id).html('<i class="fa fa-star"></i> salvo ');
                }
            });
        } else {
            $.ajax({
                type: "DELETE",
                url: "{{ URL::to('/favoritos') }}/"+id,
                data:  {'tipo': 'link', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#link'+id).html('<i class="fa-regular fa-star"></i> salvar ');
                }
            });

        }

    }


</script>
