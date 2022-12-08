<style>
    #scroll{
        overflow:auto;
    }

    .pointer {
        cursor: pointer;
    }
</style>
<x-app-layout>
    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Times</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn mt-2 salvar"  data-bs-toggle="modal" data-bs-target="#AdicionarTime">Adicionar Novo</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if(isset($times))
                                    @foreach($times as $time)
                                        <div class="col-md-4 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    @php
                                                        $qtdMembros = 0;
                                                    @endphp
                                                    <div class="flex justify-content-between">
                                                        <div class="w-100">{{$time->nome}}</div>
                                                        <div id="add-user-time" class="edt{{$time->id}} pointer"  data-bs-toggle="modal" data-bs-target="#AdicionarUserTime{{$time->id}}" style="display: none"  >
                                                            <i class="fa fa-user-plus"></i> </div><br>
                                                    </div>

                                                    @foreach($time->users as $user)
                                                        @if($user->pivot->gerente == '1')
                                                            <div id="user{{$user->id}}">
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <b>Gerente: </b> {{$user->name}}
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="edt{{$time->id}} pointer" onclick="remove({{$user->id}},{{$time->id}})"  style="display: none">
                                                                            x
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            @php
                                                                $qtdMembros ++;
                                                            @endphp
                                                        @endif

                                                    @endforeach
                                                </div>
                                                <div class="card-body pt-1 overflow-auto altura-time" >
                                                    <p style="color: darkgrey"> Membros({{$qtdMembros}})</p>
                                                    @foreach($time->users as $user)
                                                        @if($user->pivot->gerente != '1')
                                                            <div class="flex justify-content-between" id="user{{$user->id}}">
                                                                <div class="w-100">{{$user->name}}</div><div class="edt{{$time->id}} pointer" onclick="remove({{$user->id}},{{$time->id}})"  style="display: none">x</div>
                                                            </div>
                                                        @endif

                                                    @endforeach

                                                </div>
                                                <div class="card-footer flex justify-content-between">
                                                    <div class="mr-2 orange-color btn-edt{{$time->id}}" id="editarTime"  onclick="editar({{$time->id}})"> <i class="fa fa-pencil"></i> editar </div>
                                                    <div class="mr-2 orange-color btn-ok{{$time->id}}" id="editarTime" style="display: none;" onclick="confirma({{$time->id}})"> <i class="fa fa-check"></i> ok </div>

                                                    <a class="orange-color" id="deletarTime" data-bs-toggle="modal" data-bs-target="#deletartime{{$time->id}}"><i class="fa fa-trash"></i> excluir </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade modal_adicionar_time" id="AdicionarTime" tabindex="-1" aria-labelledby="AdicionarTimeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Novo Time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('time.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="titulo"  class="form-label">Nome</label>
                        <x-text-input id="name" style="width: 100%" type="text" name="nome"  required/>
                    </div>
                    <div class="my-3 col-md-10">
                        <span class="ms-1 d-none d-sm-inline">Gerente</span>
                        <br>
                        <select class="select_gerente" name="gerente" style="width: 100%">
                        </select>
                    </div>

                    <div class="my-3 col-md-10">
                        <span class="ms-1 d-none d-sm-inline">Membros</span>
                        <br>
                        <select class="select_user" name="membros[]" multiple="multiple" style="width: 100%">
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


@if(isset($times))
    @foreach($times as $time)

        <div class="modal fade modal_editar_time{{$time->id}}" id="AdicionarUserTime{{$time->id}}" tabindex="-1" aria-labelledby="AdicionarUserTime{{$time->id}}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Time {{$time->nome}} </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('time.update',$time->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Nome</label>
                                <x-text-input id="name" style="width: 100%" type="text" name="nome" value="{{$time->nome}}"  required/>
                            </div>
                            <div class="my-3 col-md-10">
                                <span class="ms-1 d-none d-sm-inline">Gerente</span>
                                <br>
                                <select class="edt_select_gerente{{$time->id}}" name="gerente" style="width: 100%">
                                </select>
                            </div>

                            <div class="my-3 col-md-10">
                                <span class="ms-1 d-none d-sm-inline">Membros</span>
                                <br>
                                <select class="edt_select_user{{$time->id}}" name="membros[]" multiple="multiple" style="width: 100%">
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



@if(isset($times))
    @foreach($times as $time)
        <div class="modal fade" id="deletartime{{$time->id}}" tabindex="-1" aria-labelledby="deletartimeLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir time</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('time.destroy',$time->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$time->nome}} ?</h1>
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





<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    $(document).ready(()=> {
        $('.select_user').select2({
            dropdownParent: $(".modal_adicionar_time"),
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

        $('.select_gerente').select2({
            dropdownParent: $(".modal_adicionar_time"),
            ajax: {
                url: "{{ URL::to('/getUserTimeGerenteJson') }}",
                processResults: (data) => {
                    console.log(data)
                    return {
                        results: data ?  data :'none'
                    };
                }
            }
        });




        @if(isset($times))
        @foreach($times as $time)

        $('.edt_select_user{{$time->id}}').select2({
            dropdownParent: $(".modal_editar_time{{$time->id}}"),
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

        $('.edt_select_gerente{{$time->id}}').select2({
            dropdownParent: $(".modal_editar_time{{$time->id}}"),
            ajax: {
                url: "{{ URL::to('/getUserTimeGerenteJson') }}",
                processResults: (data) => {
                    console.log(data)
                    return {
                        results: data ?  data :'none'
                    };
                }
            }
        });
        @endforeach
        @endif




    });

    function editar(id) {
        $('.edt'+id).show();
        $('.btn-edt'+id).hide();
        $('.btn-ok'+id).show();
    }
    function confirma(id) {
        $('.btn-edt'+id).show();
        $('.btn-ok'+id).hide();
        $('.edt'+id).hide();
    }

    function remove(user_id, time_id) {
        $.ajax({
            url: "{{ URL::to('/time/user/remove') }}/"+user_id+"/"+time_id,
            success: function(){
                console.log('sucesso');
                $('#user'+user_id).remove();
            }
        });
    }

</script>
