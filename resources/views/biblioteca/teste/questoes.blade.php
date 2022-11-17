<x-app-layout>


    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><a class ="link-rota"href="{{route('teste.index')}}">Testes </a> > {{$teste->titulo}}</h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn salvar mt-2" data-bs-toggle="modal" data-bs-target="#Adicionarquestao">Adicionar Questão</button>
                                    </div>
                                </div>
                            </div>
                            @if(isset($questoes_multi))
                                @foreach($questoes_multi as $questao_multi)
                                    <div class="item mb-4 action" data-bs-toggle="modal" data-bs-target="#showteste{{$questao_multi->id}}">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a href="" class="action" target="_blank"><b>{{$questao_multi->enunciado}}</b></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h2></h2>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="action mr-2" data-bs-toggle="modal" data-bs-target="#editarQuestaoMulti{{$questao_multi->id}}"> <i class="fa fa-check"></i> editar </a>
                                                <a class="action" data-bs-toggle="modal" data-bs-target="#deletarQuestaoMulti{{$questao_multi->id}}"><i class="fa fa-trash"></i> excluir </a>
                                            </div>
                                        </div>
                                        <hr>
                                        </a>
                                        @endforeach
                                        @endif
                                        @if(isset($questoes))
                                            @foreach($questoes as $questao)
                                                <div class="item mb-4 action" data-bs-toggle="modal" data-bs-target="#showteste{{$questao->id}}">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <a href="" class="action" target="_blank"><b>{{$questao->enunciado}}</b></a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <h2></h2>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a class="action mr-2" data-bs-toggle="modal" data-bs-target="#editarQuestao{{$questao->id}}"> <i class="fa fa-check"></i> editar </a>
                                                            <a class="action" data-bs-toggle="modal" data-bs-target="#deletarQuestao{{$questao->id}}"><i class="fa fa-trash"></i> excluir </a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    </a>
                                                    @endforeach
                                                    @endif
                                                </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


{{--   ADICIONAR QUESTOES --}}
<div class="modal fade" id="Adicionarquestao" tabindex="-1" aria-labelledby="AdicionarquestaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Questão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body  justify-content-center">
                <form id="form-add" action="{{route('teste.questao.store')}}" method="POST">
                    <input type="hidden" name="teste_id" value="{{$teste->id}}">
                    @csrf
                    <div id="questao" class="mb-3 questao">
                        <div class="card " style="width: 100%; background-color: #d7d7d7">
                            <div class="row mt-2">
                                <div class="mb-1 col-md-8 " >
                                    <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" placeholder="Digite a questão" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <select class="form-select" id="tipoQuestao" style="width: 100%" name="tipo"  >
                                        <option selected disabled>Tipo de questão</option>
                                        <option value="1">Texo</option>
                                        <option value="2">Multipla Escolha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row respostas">
                                <div class="col-md-12 d-flex justify-content-arround">
                                    <input class="form-check-input check-questao ml-2" name="iscorrect-0" type="checkbox" id="iscorrect" style="display: none">
                                    <x-text-input id="resposta" class="mb-3 ml-2" style="width: 85%" type="text" name="opcao[]" placeholder="resposta de texto" required/>
                                    <button type="button" id="addOpcao" class="btn salvar ml-2 mr-2 mb-3"  style="display: none"><i class="fa fa-plus"></i> </button>
                                </div>
                                <div id="all-respostas" class="col-md-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="questoes" class="mt-3">
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
{{-- FIM  ADICIONAR QUESTOES --}}

{{--  EDITAR QUESTOES --}}

@if($questoes_multi)
    @foreach($questoes_multi as $questao_multi)
        <div class="modal fade" id="editarQuestaoMulti{{$questao_multi->id}}" tabindex="-1" aria-labelledby="editarQuestaoMultiLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Questão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>


                    <div class="modal-body  justify-content-center">
                        <form id="form-add" action="{{route('teste.questao.update',$questao_multi->id)}}" method="POST">
                            <input type="hidden" name="teste_id" value="{{$teste->id}}">
                            <input type="hidden" name="tipo" value="2">
                            @csrf
                            <div id="questao" class="mb-3 questao">
                                <div class="card " style="width: 100%; background-color: #d7d7d7">
                                    <div class="row mt-2">
                                        <div class="mb-1 col-md-8 " >
                                            <x-text-input id="titulo" style="width: 100%" type="text" name="titulo" value="{{$questao_multi->enunciado}}" />
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <select class="form-select" id="tipoQuestao" style="width: 100%" disabled>
                                                <option selected disabled>Tipo de questão</option>
                                                <option value="1">Texo</option>
                                                <option selected value="2">Multipla Escolha</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row respostas">
                                        @php
                                        $cont = 0;
                                        @endphp
                                        @foreach($questao_multi->opcoes as $opcao)
                                        <div class="col-md-12 d-flex justify-content-arround">
                                            <input class="form-check-input check-questao ml-2" name="iscorrect-{{$opcao->id}}" type="checkbox" id="iscorrect" @if($opcao->is_correct == true) checked @endif >
                                            <x-text-input id="resposta" class="mb-3 ml-2" style="width: 85%" type="text" name="opcao[{{$opcao->id}}]" placeholder="resposta de texto" value="{{$opcao->opcao}}" required/>
                                            @if($cont == 0)
                                            <button type="button" id="addOpcaoUpd" class="btn salvar ml-2 mr-2 mb-3"><i class="fa fa-plus"></i> </button>
                                            @else
                                                <button type="button" class="btn btn-danger ml-2 mr-2 mb-3" opcao_id="{{$opcao->id}}" id="DestroyOpcao"><i  class="fa fa-minus "></i></button>
                                            @endif
                                        </div>

                                            @php
                                                $cont ++;
                                            @endphp
                                            @endforeach

                                        <div id="all-respostas-upd" class="col-md-12">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="questoes" class="mt-3">
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
        <div class="modal fade" id="editarQuestao{{$teste->id}}" tabindex="-1" aria-labelledby="editarQuestaoLabel" aria-hidden="true">
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

@if($questoes_multi)
    @foreach($questoes_multi as $questao_multi)

        <div class="modal fade" id="deletarQuestaoMulti{{$questao_multi->id}}" tabindex="-1" aria-labelledby="deletarQuestaoMultiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir teste</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('teste.questao.destroy')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$questao_multi->id}}">
                            <input type="hidden" name="tipo" value="multi">
                            <h1>Deseja realmente Excluir {{$questao_multi->enunciado}} ?</h1>
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

@if($questoes)
    @foreach($questoes as $questao)

        <div class="modal fade" id="deletarQuestao{{$questao->id}}" tabindex="-1" aria-labelledby="deletarQuestaoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir teste</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('teste.questao.destroy')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$questao->id}}">
                            <input type="hidden" name="tipo" value="texto">
                            <h1>Deseja realmente Excluir {{$questao->enunciado}} ?</h1>
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

{{-- FIM DELETAR QUESTOES --}}



<script>
    $(document).ready(function() {
        let contador = 1;

        $('.addQuestao').click(function() {
            contador ++;
            let questao = $('#questao');
            let questoes = $('#questoes')
            let clone = questao.clone(true).prop('id', 'questao'+contador);
            clone.appendTo(questoes);
        });

        $('.removeQuestao').click(function(){

            if(contador > 1 && $(this).parent().parent().parent().parent().attr('id') != 'questao' ) {
                $(this).parent().parent().parent().remove();
                contador--;
            }
        });

        $('#tipoQuestao').change(function(){
            if($(this).val()!= 1){
                if($(this).val() == 2) {
                    //  $(this).parent().parent().siblings('div.row.respostas').find('#resposta').attr('name', 'opcao-multi[]');
                }
                if($(this).val() == 3) {
                    //   $(this).parent().parent().siblings('div.row.respostas').find('#resposta').attr('name', 'opcao-single[]');
                }
                $(this).parent().parent().siblings('div.row.respostas').find('#addOpcao').show();
                $(this).parent().parent().siblings('div.row.respostas').find('#iscorrect').show();
            }else {
                $(this).parent().parent().siblings('div.row.respostas').find('#addOpcao').hide();
                //$(this).parent().parent().siblings('div.row.respostas').find('#resposta').attr('name', 'resposta[]');
                $('#all-respostas').children().remove();
            }
        })
        let aux = 0;
        $('#addOpcao').click(function (){
            aux ++;
            let resposta = $(this).prev();
            let check = $(this).prev().prev();
            let respostas = $(this).parent().parent().find('#all-respostas');
            let cloneCheck = check.clone(true);
            let clone = resposta.clone(true);
            let lessButton = '<button type="button" class="btn btn-danger ml-1" id="lessOpcao"><i  class="fa fa-minus "></i></button>';

            clone.val('');
            //  clone.attr({placeholder:"Digite a opcao", name: 'opcao-'+aux});
            cloneCheck.attr('name', 'iscorrect-'+aux);
            cloneCheck.appendTo(respostas);
            clone.appendTo(respostas);
            respostas.append(lessButton);
        })

        $(document).on('click', '#lessOpcao', function(){
            aux --;
            $(this).prev().remove();
            $(this).prev().remove();
            $(this).remove();
        })
        let auxi = 0;
        $(document).on('click', '#addOpcaoUpd', function(){
            console.log('teste')
            let resposta = $(this).prev();
            let check = $(this).prev().prev();
            let respostas = $(this).parent().parent().find('#all-respostas-upd');
            let cloneCheck = check.clone(true);
            let clone = resposta.clone(true);
            let lessButton = '<button type="button" class="btn btn-danger ml-1" id="lessOpcao"><i  class="fa fa-minus "></i></button>';
            clone.val('');
            clone.attr({placeholder:"Digite a opcao", name: 'opcaonew[]'});
            cloneCheck.attr('name', 'new_iscorrect-'+auxi);
            cloneCheck.appendTo(respostas);
            clone.appendTo(respostas);
            respostas.append(lessButton);
            auxi ++;

        })

        $(document).on('click', '#DestroyOpcao', function(){
            auxi --;
            console.log()

            $.ajax({
                url: "{{ URL::to('/teste/opcao/destroy') }}/"+$(this).attr('opcao_id'),
                success: function(){
                    $(this).prev().remove();
                    $(this).prev().remove();
                    $(this).remove();
            }
           });
        });
    })


</script>
