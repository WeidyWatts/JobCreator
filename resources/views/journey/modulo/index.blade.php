<x-app-layout>
    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator header header-creator-creator"><b>Modulos</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarmodulo">Adicionar Modulo</button>
                                    </div>
                                </div>
                            </div>

                            @if(isset($modulos))
                                @foreach($modulos as $modulo)
                                    <div class="item mb-4">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="#" class="action" target="_blank"><b>{{$modulo->titulo}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2  class="orange-color">{{$anexos[$modulo->id]}} Anexos, {{$artigos[$modulo->id]}} Artigos,{{$links[$modulo->id]}} Links, {{$testes[$modulo->id]}} Testes, {{$videos[$modulo->id]}} Videos</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="orange-color mr-2"> <i class="fa-regular fa-star"></i> salvar</a>

                                                <a class="orange-color mr-2" data-bs-toggle="modal" data-bs-target="#editarmodulo{{$modulo->id}}"> <i class="fa fa-check"></i> editar </a>

                                                <a class="orange-color" data-bs-toggle="modal" data-bs-target="#deletarmodulo{{$modulo->id}}"><i class="fa fa-trash"></i> excluir </a>
                                            </div>
                                        </div>
                                        <hr>
                                        </a>
                                        @endforeach
                                        {{ $modulos->links() }}
                                        @endif
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


<div class="modal fade" id="Adicionarmodulo" aria-labelledby="AdicionarmoduloLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator header header-creator-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar modulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <div id="form-titulo">
                    <form id='modulo_store' action="{{route('modulo.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="journey_id" value="{{$journey_id}}">
                        <div class="mb-3 col-md-10">
                            <label for="titulo-add"  class="form-label">Titulo</label>
                            <x-text-input id="titulo-add" style="width: 100%" type="text" name="titulo" required />
                        </div>
                </div>
                <div id="form-conteudo" style="display: none;">
                    <div id="form-titulo">
                            <input type="hidden" name="journey_id" value="{{$journey_id}}">
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Anexos:</span>
                                <br>
                                <select class="select_anexos" name="anexos[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                            <hr>
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Artigos:</span>
                                <br>
                                <select class="select_artigos" name="artigos[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                            <hr>
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Links:</span>
                                <br>
                                <select class="select_links" name="links[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                            <hr>
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Testes:</span>
                                <br>
                                <select class="select_testes" name="testes[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                            <hr>
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Videos:</span>
                                <br>
                                <select class="select_videos" name="states[]" multiple="multiple" style="width: 25em;">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="ds">nevada</option>
                                    <option value="dfs">teste</option>
                                    <option value="jygh">abcd</option>
                                    <option value="oliuygh">testandigfdh</option>
                                    <option value="dxcds">case if</option>
                                </select>
                            </div>
                        </form>
                    </div>




                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                <button id="next" type="button" class="btn salvar">Próximo</button>
            </div>
        </div>
    </div>
</div>

@if(isset($modulos))
    @foreach($modulos as $modulo)
        <div class="modal fade" id="editarmodulo{{$modulo->id}}" tabindex="-1" aria-labelledby="editarmoduloLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar modulo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('modulo.update',$modulo->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo</label>
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$modulo->titulo}}" />
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


@if(isset($modulos))
    @foreach($modulos as $modulo)
        <div class="modal fade" id="deletarmodulo{{$modulo->id}}" tabindex="-1" aria-labelledby="deletarmoduloLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir modulo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('modulo.destroy',$modulo->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$modulo->titulo}} ?</h1>
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

    $(document).ready(()=>{
        $('.select_anexos').select2({
            dropdownParent: $("#Adicionarmodulo"),
            ajax: {
                url: "{{ URL::to('/getAnexoJson') }}",
                processResults: (data)=>{
                    console.log(data)
                    return {
                        results: data
                    };
                }
            }
        });

        $('.select_artigos').select2({
            dropdownParent: $("#Adicionarmodulo"),
            ajax: {
                url: "{{ URL::to('/getArtigoJson') }}",
                processResults: (data)=>{
                    console.log(data)
                    return {
                        results: data
                    };
                }
            }
        });


        $('.select_links').select2({
            dropdownParent: $("#Adicionarmodulo"),
            ajax: {
                url: "{{ URL::to('/getLinkJson') }}",
                processResults: (data)=>{
                    console.log(data)
                    return {
                        results: data
                    };
                }
            }
        });

        $('.select_testes').select2({
            dropdownParent: $("#Adicionarmodulo"),
            ajax: {
                url: "{{ URL::to('/getTesteJson') }}",
                processResults: (data)=>{
                    console.log(data)
                    return {
                        results: data
                    };
                }
            }
        });

        $('.select_videos').select2({
            dropdownParent: $("#Adicionarmodulo"),
            ajax: {
                url: "{{ URL::to('/getVideoJson') }}",
                processResults: (data)=>{
                    console.log(data)
                    return {
                        results: data
                    };
                }
            }
        });


        $(document).on('click','#next', ()=>{
            if($('#titulo-add').val()) {
                $('#form-titulo').hide();
                $('#form-conteudo').show();
                $('#next').html('Salvar');
                $('#next').attr('id', 'save');
            }else {
                alert('Digite um titulo!');
            }
        })


        $(document).on('click','#save', ()=>{
          $('#modulo_store').submit();
        });

    });
    function show(id) {
        window.location.href = '/modulo/'+id;
    }
</script>
