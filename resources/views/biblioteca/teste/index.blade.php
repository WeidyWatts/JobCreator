<x-app-layout>
    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Testes</b></h1>
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
                                            <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarteste">Adicionar Novo</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(isset($testes))
                                @foreach($testes as $teste)
                                    <div class="item mb-4 action">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="{{$teste->link}}" class="action" target="_blank"><b>{{$teste->titulo}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2 class="orange-color">{{$teste->descricao}}</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="mr-2 orange-color" id="teste{{$teste->id}}" onclick="favoritar({{$teste->id}})">@if(in_array($teste->id, $favoritos))<i class="fa fa-star"></i> salvo @else<i class="fa-regular fa-star"></i> salvar @endif</a>
                                                @if(auth()->user()->user_type != 3)

                                                    <a class="action mr-2 orange-color" data-bs-toggle="modal" data-bs-target="#editarteste{{$teste->id}}"> <i class="fa fa-check"></i> editar </a>

                                                    <a class="action orange-color" data-bs-toggle="modal" data-bs-target="#deletarteste{{$teste->id}}"><i class="fa fa-trash"></i> excluir </a>
                                                @endif
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Teste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body ">
                <form action="{{route('teste.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="flex-row">
                        <label for="titulo"  class="form-label">Titulo</label>
                        <x-text-input id="titulo" style="width: 100%" type="text" name="titulo"  />
                    </div>

                    <div class="flex-row">
                        <label for="descricao"  class="form-label">Descrição </label>
                        <x-text-input id="descricao" style="width: 100%" type="text" name="descricao"  />
                    </div>

                    <div class="flex-row">
                        <label for="link"  class="form-label">Link </label>
                        <x-text-input id="link" style="width: 100%" type="text" name="link"  />
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

@if(isset($testes))
    @foreach($testes as $teste)
        <div class="modal fade" id="editarteste{{$teste->id}}" tabindex="-1" aria-labelledby="editartesteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Teste</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('teste.update',$teste->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="flex-row">
                                <label for="titulo"  class="form-label">Titulo</label>
                                <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$teste->titulo}}" />
                            </div>
                            <div class="flex-row">
                                <label for="descricao"  class="form-label">Descrição </label>
                                <x-text-input id="descricao" style="width: 100%" type="text" name="descricao" value="{{$teste->descricao}}" />
                            </div>
                            <div class="flex-row">
                                <label for="link"  class="form-label">Link </label>
                                <x-text-input id="link" style="width: 100%" type="text" name="link" value="{{$teste->link}}" />
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
                        <h5 class="modal-title" id="exampleModalLabel">Excluir Teste</h5>
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

<script>
    // $(document).ready(function() {
    //     let contador = 1;
    //
    //     $('.addQuestao').click(function() {
    //         contador ++;
    //         let questao = $('#questao');
    //         let questoes = $('#questoes')
    //         let clone = questao.clone(true).prop('id', 'questao'+contador);
    //         clone.appendTo(questoes);
    //     });
    //
    //     $('.removeQuestao').click(function(){
    //
    //         if(contador > 1 && $(this).parent().parent().parent().parent().attr('id') != 'questao' ) {
    //             $(this).parent().parent().parent().remove();
    //             contador--;
    //         }
    //     });
    //
    //     $('#tipoQuestao').change(function(){
    //         if($(this).val()!= 1){
    //             if($(this).val() == 2) {
    //                 $(this).parent().parent().siblings('div.row.respostas').find('#resposta').attr('name', 'opcao-multi[]');
    //             }
    //             if($(this).val() == 3) {
    //                 $(this).parent().parent().siblings('div.row.respostas').find('#resposta').attr('name', 'opcao-single[]');
    //             }
    //             $(this).parent().parent().siblings('div.row.respostas').find('#addOpcao').show();
    //         }else {
    //             $(this).parent().parent().siblings('div.row.respostas').find('#addOpcao').hide();
    //             $(this).parent().parent().siblings('div.row.respostas').find('#resposta').attr('name', 'resposta[]');
    //             $('#all-respostas').children().remove();
    //         }
    //     })
    //
    //     $('#addOpcao').click(function (){
    //         let resposta = $(this).prev();
    //         let respostas = $(this).parent().parent().find('#all-respostas');
    //         let clone = resposta.clone(true);
    //         let lessButton = '<button type="button" class="btn btn-danger ml-2" id="lessOpcao"><i  class="fa fa-minus "></i></button>';
    //         clone.appendTo(respostas);
    //         respostas.append(lessButton);
    //     })
    //
    //     $(document).on('click', '#lessOpcao', function(){
    //         $(this).prev().remove();
    //         $(this).remove();
    //     })
    // })

    //
    //
    // function show(id) {
    //     window.location.href = '/teste/'+id;
    // }


    function favoritar(id){
        if($('#teste'+id).html() != '<i class="fa fa-star"></i> salvo '){

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/favoritos') }}",
                data:  {'tipo': 'teste', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#teste'+id).html('<i class="fa fa-star"></i> salvo ');
                }
            });
        } else {
            $.ajax({
                type: "DELETE",
                url: "{{ URL::to('/favoritos') }}/"+id,
                data:  {'tipo': 'teste', 'item_id': id, '_token': '{{ csrf_token() }}'},
                success: function(){
                    $('#teste'+id).html('<i class="fa-regular fa-star"></i> salvar ');
                }
            });

        }

    }
</script>

