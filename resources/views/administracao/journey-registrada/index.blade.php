<x-app-layout>
    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Journeys Registradas</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn mt-2 salvar"  data-bs-toggle="modal" data-bs-target="#AdicionarJourney">Adicionar Novo</button>
                                    </div>
                                </div>
                            </div>
                            @if(isset($journeys))
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Criado em</th>
                                        <th scope="col">Avaliação</th>
                                        <th scope="col">Usuarios</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($journeys as $journey)
                                        <tr>
                                            <td>{{$journey->titulo}}</td>
                                            <td> {{ Carbon\Carbon::parse($journey->created_at)->format('d/m/Y') ?? ''}}   </td>
                                            <td>5</td>
                                            <td>
                                                <div class="row">
                                                    <div class="flex justify-content-around">
                                                        <div class="col-md-8">
                                                            Total de inscritos
                                                        </div>
                                                        <div class="col-md-2" style="background-color: grey">
                                                            {{count($journey->users)}}
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="flex justify-content-around">
                                                        <div class="col-md-8">
                                                            Em Execução
                                                        </div>
                                                        <div class="col-md-2" style="background-color: yellow">
                                                            @php
                                                                $exec = 0;
                                                            @endphp
                                                            @foreach($journey->users as $user)
                                                                @if($user->pivot->percentual_concluido > 0)
                                                                    @php
                                                                        $exec++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            {{$exec}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="flex justify-content-around">
                                                        <div class="col-md-8">
                                                            Concluido
                                                        </div>
                                                        <div class="col-md-2" style="background-color: greenyellow">
                                                            @php
                                                                $conc = 0;
                                                            @endphp
                                                            @foreach($journey->users as $user)
                                                                @if($user->pivot->percentual_concluido == 100)
                                                                    @php
                                                                        $conc++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            {{$conc}}
                                                        </div>
                                                    </div>
                                                </div>


                                            </td>
                                            <td >
                                                <a href="#" class="flex justify-content-center mt-3"style="font-size: 2em;"  data-bs-toggle="modal" data-bs-target="#VincularUserJourney{{$journey->id}}"> <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="AdicionarJourney" tabindex="-1" aria-labelledby="AdicionarJourneyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Journey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('journey.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="name"  class="form-label">Nome da Journey</label>
                        <x-text-input id="name" style="width: 100%" type="text" name="name" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="email"  class="form-label">Email</label>
                        <x-text-input id="email" style="width: 100%" type="text" name="email" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="cargo"  class="form-label">Cargo</label>
                        <x-text-input id="cargo" style="width: 100%" type="text" name="cargo" />
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
        <div class="modal fade modal_vincular_usuario" id="VincularUserJourney{{$journey->id}}" tabindex="-1" aria-labelledby="VincularUserJourneyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastar Usuario a Journey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('journey-registrada.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="journey_id" value="{{$journey->id}}">
                            <div class="my-3 col-md-10">
                                <span class="ms-1 d-none d-sm-inline">Selecione os usuarios</span>
                                <br>
                                <select class="select_user" name="usuarios[]" multiple="multiple" style="width: 100%">
                                </select>
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
        <div class="modal fade" id="editarJourney{{$journey->id}}" tabindex="-1" aria-labelledby="editarJourneyLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Journey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('journey.update',$journey->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo do Journey</label>
                                <x-text-input id="name" style="width: 100%" type="text" name="titulo" value="{{$journey->nome_journey}}" />
                            </div>
                            <div class="mb-3">
                                <label for="anexc" class="form-label">Journey</label>
                                <input type="file" name="journey" class="form-control">
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
        <div class="modal fade" id="deletarJourney{{$journey->id}}" tabindex="-1" aria-labelledby="deletarJourneyLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir Journey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('journey.destroy',$journey->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$journey->nome_journey}} ?</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn salvar">Deletar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @endforeach
@endif


<script>

    $(document).ready(()=> {
        $('.select_user').select2({
            dropdownParent: $(".modal_vincular_usuario"),
            placeholder: 'selecione os membros',
            ajax: {
                url: "{{ URL::to('/getUserTimeJson') }}",
                processResults: (data) => {
                    console.log(data)
                    return {
                        results: data
                    };
                }
            }
        });
    });
</script>
