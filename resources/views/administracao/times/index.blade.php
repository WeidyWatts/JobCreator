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

                                {{--Foreach here --}}

                                @if(isset($times))
                                    @foreach($times as $time)
                                <div class="col-md-4 mt-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <b>Nome do time</b> <br>
                                            Gerente: @foreach($time->users as $user)
                                                         @if($user->cargo == 'gerente')
                                                {{$user->name}} <br>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="card-body pt-1">
                                            <p style="color: darkgrey"> Membros({{count($time->users)}})</p>
                                            @foreach($time->users as $user)
                                              {{$user->name}} <br>
                                            @endforeach
                                        </div>
                                        <div class="card-footer flex justify-content-between">
                                            <a class="mr-2 orange-color" data-bs-toggle="modal" data-bs-target="#editarTime"> <i class="fa fa-check"></i> editar </a>

                                            <a class="orange-color" data-bs-toggle="modal" data-bs-target="#deletarTime"><i class="fa fa-trash"></i> excluir </a>
                                        </div>
                                    </div>
                                </div
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
    });
</script>
