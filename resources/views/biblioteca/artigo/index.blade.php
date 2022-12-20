<style>
    .action {
        cursor: pointer;
    }
</style>
<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator header header-creator-creator"><b>Artigos</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarartigo">Adicionar Novo</button>
                                    </div>
                                </div>
                            </div>

                            @if(isset($artigos))
                                @foreach($artigos as $artigo)
                                    <div class="item mb-4">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="{{$artigo->link}}" class="action" target="_blank"><b>{{$artigo->titulo}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2  class="orange-color"><i>{{$artigo->autor}}</i></h2>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2  class="orange-color">{{$artigo->ano_publicacao}}</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="mr-2 orange-color" id="artigo{{$artigo->id}}" onclick="favoritar({{$artigo->id}})">@if(in_array($artigo->id, $favoritos))<i class="fa fa-star"></i> salvo @else<i class="fa-regular fa-star"></i> salvar @endif</a>

                                                <a class="orange-color mr-2" data-bs-toggle="modal" data-bs-target="#editarartigo{{$artigo->id}}"> <i class="fa fa-check"></i> editar </a>

                                                <a class="orange-color" data-bs-toggle="modal" data-bs-target="#deletarartigo{{$artigo->id}}"><i class="fa fa-trash"></i> excluir </a>
                                            </div>
                                        </div>
                                        <hr>
                                    </a>
                                @endforeach
                                {{ $artigos->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="Adicionarartigo" tabindex="-1" aria-labelledby="AdicionarartigoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-creator header header-creator-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Artigo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('artigo.store')}}" method="POST">
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
                        <label for="autor"  class="form-label">Autor </label>
                        <x-text-input id="autor" style="width: 100%" type="text" name="autor" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="ano_publicacao"  class="form-label">Ano de publicação</label>
                        <x-text-input id="ano_publicacao" style="width: 100%" type="text" name="ano_publicacao" />
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

@if(isset($artigos))
    @foreach($artigos as $artigo)
        <div class="modal fade" id="editarartigo{{$artigo->id}}" tabindex="-1" aria-labelledby="editarartigoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar artigo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('artigo.update',$artigo->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo</label>
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$artigo->titulo}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="link"  class="form-label">Link </label>
                                <x-text-input id="link" style="width: 100%" type="text" name="link" value="{{$artigo->link}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="autor"  class="form-label">Autor </label>
                                <x-text-input id="autor" style="width: 100%" type="text" name="autor" value="{{$artigo->autor}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="ano_publicacao"  class="form-label">Ano de publicação</label>
                                <x-text-input id="ano_publicacao" style="width: 100%" type="text" name="ano_publicacao" value="{{$artigo->ano_publicacao}}" />
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


@if(isset($artigos))
    @foreach($artigos as $artigo)
        <div class="modal fade" id="deletarartigo{{$artigo->id}}" tabindex="-1" aria-labelledby="deletarartigoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir artigo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('artigo.destroy',$artigo->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$artigo->titulo}} ?</h1>
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
        console.log($('#artigo'+id).html())
        if($('#artigo'+id).html() != '<i class="fa fa-star"></i> salvo '){

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/favoritos') }}",
                data:  {'tipo': 'artigo', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#artigo'+id).html('<i class="fa fa-star"></i> salvo ');
                }
            });
        } else {
            $.ajax({
                type: "DELETE",
                url: "{{ URL::to('/favoritos') }}/"+id,
                data:  {'tipo': 'artigo', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#artigo'+id).html('<i class="fa-regular fa-star"></i> salvar ');
                }
            });

        }

    }
</script>
