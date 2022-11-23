<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator header header-creator-creator"><b>Minhas Journeys</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarjourney">Adicionar Journey</button>
                                    </div>
                                </div>
                            </div>

                            @if(isset($journeys))
                                @foreach($journeys as $journey)
                                    <div class="item mb-4" onclick="show({{$journey->id}})">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="#" class="action" target="_blank"><b>{{$journey->titulo}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2  class="orange-color"><i>10 modulos</i></h2>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2  class="orange-color">6 horas</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="orange-color mr-2"> <i class="fa-regular fa-star"></i> salvar</a>

                                                <a class="orange-color mr-2" data-bs-toggle="modal" data-bs-target="#editarjourney{{$journey->id}}"> <i class="fa fa-check"></i> editar </a>

                                                <a class="orange-color" data-bs-toggle="modal" data-bs-target="#deletarjourney{{$journey->id}}"><i class="fa fa-trash"></i> excluir </a>
                                            </div>
                                        </div>
                                        <hr>
                                        </a>
                                        @endforeach
                                        {{ $journeys->links() }}
                                        @endif
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


<div class="modal fade" id="Adicionarjourney" tabindex="-1" aria-labelledby="AdicionarjourneyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-creator header header-creator-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar journey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('journey.store')}}" method="POST">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="titulo"  class="form-label">Titulo</label>
                        <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" required />
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

@if(isset($journeys))
    @foreach($journeys as $journey)
        <div class="modal fade" id="editarjourney{{$journey->id}}" tabindex="-1" aria-labelledby="editarjourneyLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar journey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('journey.update',$journey->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo</label>
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$journey->titulo}}" />
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


@if(isset($journeys))
    @foreach($journeys as $journey)
        <div class="modal fade" id="deletarjourney{{$journey->id}}" tabindex="-1" aria-labelledby="deletarjourneyLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir journey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('journey.destroy',$journey->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$journey->titulo}} ?</h1>
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
function show(id) {
window.location.href = '/journey/'+id;
}
</script>
