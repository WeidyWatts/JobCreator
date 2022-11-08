<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator">Testes</h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarteste">Adicionar Novo</button>
                                    </div>
                                </div>
                            </div>

                            @if(isset($testes))
                                @foreach($testes as $teste)
                                    <div class="item mb-4 action" data-bs-toggle="modal" data-bs-target="#showteste{{$teste->id}}">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="{{$teste->link}}" class="action" target="_blank"><b>{{$teste->titulo}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2>{{$teste->descricao}}</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="action mr-2"> <i class="fa-regular fa-star"></i>salvar</a>

                                                <a class="action mr-2" data-bs-toggle="modal" data-bs-target="#editarteste{{$teste->id}}"> <i class="fa fa-check"></i> editar </a>

                                                <a class="action" data-bs-toggle="modal" data-bs-target="#deletarteste{{$teste->id}}"><i class="fa fa-trash"></i> excluir </a>
                                            </div>
                                        </div>
                                        <hr>
                                        </a>
                                        @endforeach
                                        {{ $testes->links() }}
                                        @endif
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>

<div class="modal fade" id="Adicionarteste" tabindex="-1" aria-labelledby="AdicionartesteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar teste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body d-flex justify-content-center">



                <div class="card " style="width: 100%; background-color: #d7d7d7">
                    <form action="{{route('teste.store')}}" method="POST">
                        @csrf
                        <div class="row mt-2">
                            <div class="mb-1 col-md-8 " >
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" placeholder="Digite a questão" />
                            </div>
                            <div class="mb-1 col-md-4">
                                <select class="form-select" style="width: 100%" >
                                    <option selected disabled>Tipo de questão</option>
                                    <option value="1">Texo</option>
                                    <option value="2">Multipla seleção</option>
                                    <option value="3">Seleção Unica</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12 d-flex justify-content-between">
                                <x-text-input id="descricao" style="width: 90%" type="text" name="descricao" placeholder="resposta de texto" />
                                <button class="btn salvar ml-2 mr-2"><i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn salvar">Salvar</button>
            </div>

        </div>
    </div>
</div>

@if(isset($testes))
    @foreach($testes as $teste)
        <div class="modal fade" id="editarteste{{$teste->id}}" tabindex="-1" aria-labelledby="editartesteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar teste</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('teste.update',$teste->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo</label>
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$teste->titulo}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="link"  class="form-label">Link </label>
                                <x-text-input id="link" style="width: 100%" type="text" name="link" value="{{$teste->link}}" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="descricao"  class="form-label">Descricao </label>
                                <x-text-input id="descricao" style="width: 100%" type="text" name="descricao" value="{{$teste->descricao}}" />
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


@if(isset($testes))
    @foreach($testes as $teste)
        <div class="modal fade" id="deletarteste{{$teste->id}}" tabindex="-1" aria-labelledby="deletartesteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir teste</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('teste.destroy',$teste->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$teste->titulo}} ?</h1>
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


@if(isset($testes))
    @foreach($testes as $teste)
        <div class="modal fade" id="showteste{{$teste->id}}" tabindex="-1" aria-labelledby="showtesteLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">{{$teste->titulo}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="100%" height="400rem" src="{{$teste->link}}"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

