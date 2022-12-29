<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Videos</b></h1>
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
                                            <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarvideo">Adicionar Novo</button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if(isset($videos))
                                @foreach($videos as $video)
                                    <div class="item mb-4 action" >
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="#" class="action" data-bs-toggle="modal" data-bs-target="#showvideo{{$video->id}}"><b>{{$video->titulo}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2 class="orange-color">{{$video->descricao}}</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="mr-2 orange-color" id="video{{$video->id}}" onclick="favoritar({{$video->id}})">@if(in_array($video->id, $favoritos))<i class="fa fa-star"></i> salvo @else<i class="fa-regular fa-star"></i> salvar @endif</a>

                                                <a class="orange-color mr-2" data-bs-toggle="modal" data-bs-target="#editarvideo{{$video->id}}"> <i class="fa fa-check"></i> editar </a>

                                                <a class="orange-color" data-bs-toggle="modal" data-bs-target="#deletarvideo{{$video->id}}"><i class="fa fa-trash"></i> excluir </a>
                                            </div>
                                        </div>
                                        <hr>
                                        </a>
                                        @endforeach
                                        {{ $videos->links() }}
                                        @endif
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>

<div class="modal fade" id="Adicionarvideo" tabindex="-1" aria-labelledby="AdicionarvideoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('video.store')}}" method="POST">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="titulo"  class="form-label">Titulo</label>
                        <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="descricao"  class="form-label">Descrição </label>
                        <x-text-input id="descricao" style="width: 100%" type="text" name="descricao" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="link"  class="form-label">Link</label>
                        <x-text-input id="link" style="width: 100%" type="text" name="link" />
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

@if(isset($videos))
    @foreach($videos as $video)
        <div class="modal fade" id="editarvideo{{$video->id}}" tabindex="-1" aria-labelledby="editarvideoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('video.update',$video->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo</label>
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$video->titulo}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="descricao"  class="form-label">Descrição </label>
                                <x-text-input id="descricao" style="width: 100%" type="text" name="descricao" value="{{$video->descricao}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="link"  class="form-label">Link </label>
                                <x-text-input id="link" style="width: 100%" type="text" name="link" value="{{$video->link}}" />
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


@if(isset($videos))
    @foreach($videos as $video)
        <div class="modal fade" id="deletarvideo{{$video->id}}" tabindex="-1" aria-labelledby="deletarvideoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('video.destroy',$video->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$video->titulo}} ?</h1>
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


@if(isset($videos))
    @foreach($videos as $video)
        <div class="modal fade" id="showvideo{{$video->id}}" tabindex="-1" aria-labelledby="showvideoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">{{$video->titulo}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="100%" height="400rem" src="{{$video->link}}"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<script>

    function favoritar(id){
        console.log($('#video'+id).html())
        if($('#video'+id).html() != '<i class="fa fa-star"></i> salvo '){

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/favoritos') }}",
                data:  {'tipo': 'video', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#video'+id).html('<i class="fa fa-star"></i> salvo ');
                }
            });
        } else {
            $.ajax({
                type: "DELETE",
                url: "{{ URL::to('/favoritos') }}/"+id,
                data:  {'tipo': 'video', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#video'+id).html('<i class="fa-regular fa-star"></i> salvar ');
                }
            });

        }

    }


</script>
