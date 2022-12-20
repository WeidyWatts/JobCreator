<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Favoritos</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                </div>
                            </div>
                            @if(isset($anexos))
                                @foreach($anexos as $anexo)
                                    <div class="item mb-4" id="item-anexo{{$anexo->id}}">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h1><b>{{$anexo->titulo}}</b></h1>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-7">
                                                <a class="orange-color" href="{{route('anexo.download',$anexo->arquivo_anexo)}}" target="_blank"> <h2>Fazer Download do Anexo</h2></a>
                                            </div>
                                            <div class="col-md-4">
                                            <a href="#" class="orange-color" onclick="remover_anexo({{$anexo->id}})" ><i class="fa fa-close"></i> Remover</a>

                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif

                            @if(isset($artigos))
                                @foreach($artigos as $artigo)
                                    <div class="item mb-4" id="item-artigo{{$artigo->id}}">
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
                                            <div class="col-md-4">
                                                <a href="#" class="orange-color" onclick="remover_artigo({{$artigo->id}})" ><i class="fa fa-close"></i> Remover</a>
                                            </div>
                                        </div>
                                        <hr>
                                        </a>
                                        @endforeach
                                        @endif

                                        @if(isset($links))
                                            @foreach($links as $link)
                                                <div class="item mb-4"id="item-link{{$link->id}}">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <a href="{{$link->link}}" class="action" target="_blank"><b>{{$link->titulo}}</b></a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <h2 class="orange-color">{{$link->descricao}}</h2>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="#" class="orange-color" onclick="remover_link({{$link->id}})" ><i class="fa fa-close"></i> Remover</a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    </a>
                                                </div>
                                                    @endforeach
                                                    @endif


                                                @if(isset($testes))
                                                    @foreach($testes as $teste)
                                                        <div class="item mb-4" id="item-teste{{$teste->id}}">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <a href="{{$teste->link}}" class="action" target="_blank"><b>{{$teste->titulo}}</b></a>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <h2>{{$teste->descricao}}</h2>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <a href="#" class="orange-color" onclick="remover_teste({{$teste->id}})" ><i class="fa fa-close"></i> Remover</a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            </a>
                                                        </div>
                                                            @endforeach
                                                            @endif

                                                        @if(isset($videos))
                                                            @foreach($videos as $video)
                                                                <div class="item mb-4 action" id="item-video{{$video->id}}">
                                                                    <div class="row mb-2">
                                                                        <div class="col-md-6">
                                                                            <a href="#" class="action" data-bs-toggle="modal" data-bs-target="#showvideo{{$video->id}}"><b>{{$video->titulo}}</b></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-md-6">
                                                                            <h2 class="orange-color">{{$video->descricao}}</h2>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <a href="#" class="orange-color" onclick="remover_video({{$video->id}})" ><i class="fa fa-close"></i> Remover</a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    </a>
                                                                </div>
                                                                    @endforeach
                                                                    @endif

                                    </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
<script>
    function remover_anexo(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/favoritos') }}/"+id,
            data:  {'tipo': 'anexo', 'item_id': id, '_token': '{{ csrf_token() }}'},
            success: function(){
                $('#item-anexo'+id).remove();
            }
        });
    }
    function remover_artigo(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/favoritos') }}/"+id,
            data:  {'tipo': 'artigo', 'item_id': id, '_token': '{{ csrf_token() }}'},
            success: function(){
                $('#item-artigo'+id).remove();
            }
        });

    }
    function remover_link(id){

        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/favoritos') }}/"+id,
            data:  {'tipo': 'link', 'item_id': id, '_token': '{{ csrf_token() }}'},
            success: function(){
                $('#item-link'+id).remove();
            }
        });

    }
    function remover_teste(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/favoritos') }}/"+id,
            data:  {'tipo': 'teste', 'item_id': id, '_token': '{{ csrf_token() }}'},
            success: function(){
                $('#item-teste'+id).remove();
            }
        });

    }
    function remover_video(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/favoritos') }}/"+id,
            data:  {'tipo': 'video', 'item_id': id, '_token': '{{ csrf_token() }}'},
            success: function(){
                $('#item-video'+id).remove();
            }
        });

    }
</script>
