<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator header header-creator-creator"><b> {{$modulo->titulo}}</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">

                            <ul class="list-group">

                                <li href="#dropAnexo" data-bs-toggle="collapse"  class="pointer list-group-item d-flex justify-content-between align-items-center">
                                    <div class="flex-item">
                                        <a class="nav-link px-0 align-middle">
                                            Anexos </a>
                                        <ul class="collapse ml-5 item" id="dropAnexo" data-bs-parent="#menu1">
                                            @foreach($anexos as $anexo)
                                                <li>
                                                    <div class="teste" onclick="link('{{route('anexo.download',$anexo->arquivo_anexo)}}')">
                                                        <a href="{{route('anexo.download',$anexo->arquivo_anexo)}}"> &bull; {{$anexo->titulo}} </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>

                                        <span class="badge bg-primary rounded-pill ">{{count($anexos)}}</span>
                                        @if(auth()->user()->user_type != 3)
                                            <i data-bs-toggle="modal" data-bs-target="#upd-anexo" class="fa fa-pen"></i>
                                        @endif
                                    </div>


                                </li>


                                <li href="#dropArtigo" data-bs-toggle="collapse"  class="pointer list-group-item d-flex justify-content-between align-items-center">
                                    <div class="flex-item">
                                        <a class="nav-link px-0 align-middle">
                                            Artigos </a>
                                        <ul class="collapse  ml-5" id="dropArtigo" data-bs-parent="#menu1">
                                            @foreach($artigos as $artigo)
                                                <li>
                                                    <div class="teste" onclick="link('{{$artigo->link}}')">
                                                        <a href="{{$artigo->link}}" target="_blank"> &bull; {{$artigo->titulo}} </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary rounded-pill">{{count($artigos)}}</span>
                                        @if(auth()->user()->user_type != 3)
                                            <i data-bs-toggle="modal" data-bs-target="#upd-artigo" class="fa fa-pen"></i>
                                        @endif

                                    </div>
                                </li>



                                <li href="#dropLink" data-bs-toggle="collapse"  class="pointer list-group-item d-flex justify-content-between align-items-center">
                                    <div class="flex-item">
                                        <a class="nav-link px-0 align-middle">
                                            Links </a>
                                        <ul class="collapse  ml-5" id="dropLink" data-bs-parent="#menu1">
                                            @foreach($links as $link)
                                                <li>
                                                    <div class="teste" onclick="link('{{$link->link}}')">
                                                        <a href="{{$link->link}}" target="_blank"> &bull; {{$link->titulo}} </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary rounded-pill">{{count($links)}}</span>
                                        @if(auth()->user()->user_type != 3)
                                            <i data-bs-toggle="modal" data-bs-target="#upd-link" class="fa fa-pen"></i>
                                        @endif
                                    </div>
                                </li>


                                <li href="#dropVideo" data-bs-toggle="collapse"  class="pointer list-group-item d-flex justify-content-between align-items-center">
                                    <div class="flex-item">
                                        <a class="nav-link px-0 align-middle">
                                            Videos </a>
                                        <ul class="collapse  ml-5" id="dropVideo" data-bs-parent="#menu1">
                                            @foreach($videos as $video)
                                                <li>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#showvideo{{$video->id}}"> &bull; {{$video->titulo}} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary rounded-pill">{{count($videos)}}</span>
                                        @if(auth()->user()->user_type != 3)
                                            <i data-bs-toggle="modal" data-bs-target="#upd-video" class="fa fa-pen"></i>
                                        @endif
                                    </div>
                                </li>



                                <li href="#dropTeste" data-bs-toggle="collapse"  class="pointer list-group-item d-flex justify-content-between align-items-center">
                                    <div class="flex-item">
                                        <a class="nav-link px-0 align-middle">
                                            Testes </a>
                                        <ul class="collapse  ml-5" id="dropTeste" data-bs-parent="#menu1">
                                            @foreach($testes as $teste)
                                                <li>
                                                    <div class="teste" onclick="link('{{$teste->link}}')">

                                                        <a href="{{$teste->link}}"> &bull; {{$teste->titulo}} </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary rounded-pill">{{count($testes)}}</span>
                                        @if(auth()->user()->user_type != 3)
                                            <i data-bs-toggle="modal" data-bs-target="#upd-teste" class="fa fa-pen"></i>
                                        @endif
                                    </div>
                                </li>

                            </ul>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="">
                                    <form action="{{route('journey-registrada.update',auth()->user()->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="journey_id" value="{{$journey_id}}">
                                        <button type="submit" class="btn btn-primary">Concluir</button>
                                    </form>
                                </a>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




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

<div class="modal fade" id="upd-anexo" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Editar Anexos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach($anexos as $anexo)
                                <li class="list-group-item" id="anexo{{$anexo->id}}">
                                    <div class="d-flex justify-content-between">
                                        {{$anexo->titulo}}
                                        <i class="fa fa-trash pointer" onclick="delete_anexo({{$anexo->id}})"></i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="mt-2">
                <div class="d-flex justify-content-center">
                    <form action="{{route('modulo.update',$modulo->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tipo" value="anexo">
                        <div class="col-md-8">
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Anexos:</span>
                                <br>
                                <select class="select_anexos" name="anexos[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                        </div>
                        <button type="submit"  class="btn salvar"   >Salvar</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn salvar"  data-bs-dismiss="modal" onclick="reload()">OK</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upd-artigo" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Editar Artigos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach($artigos as $artigo)
                                <li class="list-group-item" id="artigo{{$artigo->id}}">
                                    <div class="d-flex justify-content-between">
                                        {{$artigo->titulo}}
                                        <i class="fa fa-trash pointer" onclick="delete_artigo({{$artigo->id}})"></i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="mt-2">
                <div class="d-flex justify-content-center">
                    <form action="{{route('modulo.update',$modulo->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tipo" value="artigo">
                        <div class="col-md-8">
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Artigos:</span>
                                <br>
                                <select class="select_artigos" name="artigos[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                        </div>
                        <button type="submit"  class="btn salvar">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn salvar"  data-bs-dismiss="modal" onclick="reload()">OK</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upd-link" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Editar Links</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach($links as $link)
                                <li class="list-group-item" id="link{{$link->id}}">
                                    <div class="d-flex justify-content-between">
                                        {{$link->titulo}}
                                        <i class="fa fa-trash pointer" onclick="delete_link({{$link->id}})"></i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="mt-2">
                <div class="d-flex justify-content-center">
                    <form action="{{route('modulo.update',$modulo->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tipo" value="link">
                        <div class="col-md-8">
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Links:</span>
                                <br>
                                <select class="select_links" name="links[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                        </div>
                        <button type="submit"  class="btn salvar">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn salvar"  data-bs-dismiss="modal" onclick="reload()">OK</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upd-video" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Editar Videos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach($videos as $video)
                                <li class="list-group-item" id="video{{$video->id}}">
                                    <div class="d-flex justify-content-between">
                                        {{$video->titulo}}
                                        <i class="fa fa-trash pointer" onclick="delete_video({{$video->id}})"></i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="mt-2">
                <div class="d-flex justify-content-center">
                    <form action="{{route('modulo.update',$modulo->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tipo" value="video">
                        <div class="col-md-8">
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Videos:</span>
                                <br>
                                <select class="select_videos" name="videos[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                        </div>
                        <button type="submit"  class="btn salvar">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn salvar"  data-bs-dismiss="modal" onclick="reload()">OK</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upd-teste" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Editar Testes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach($testes as $teste)
                                <li class="list-group-item" id="teste{{$teste->id}}">
                                    <div class="d-flex justify-content-between">
                                        {{$teste->titulo}}
                                        <i class="fa fa-trash pointer" onclick="delete_teste({{$teste->id}})"></i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="mt-2">
                <div class="d-flex justify-content-center">
                    <form action="{{route('modulo.update',$modulo->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tipo" value="teste">
                        <div class="col-md-8">
                            <div class="my-3 col-md-10">
                                <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca >  Testes:</span>
                                <br>
                                <select class="select_testes" name="testes[]" multiple="multiple" style="width: 25em;">
                                </select>
                            </div>
                        </div>
                        <button type="submit"  class="btn salvar">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn salvar"  data-bs-dismiss="modal" onclick="reload()">OK</button>

            </div>
        </div>
    </div>
</div>

<script>


    $(document).ready(()=>{
        $(document).on('click', '.flex-item', function(event){
            console.log(event)
            event.stopPropagation();
        });
    })


    function link(nova){
        window.open(nova, '_blank');
    }

    $(document).ready(()=> {

        $('.select_anexos').select2({
            dropdownParent: $("#upd-anexo"),
            ajax: {
                url: "{{ URL::to('/getAnexoJson') }}",
                processResults: (data) => {
                    console.log(data)
                    return {
                        results: data
                    };
                }
            }
        });

        $('.select_artigos').select2({
            dropdownParent: $("#upd-artigo"),
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
            dropdownParent: $("#upd-link"),
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
            dropdownParent: $("#upd-teste"),
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
            dropdownParent: $("#upd-video"),
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



    });

    function delete_anexo(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/modulo_conteudo') }}/"+id,
            data:  {'tipo': 'anexo', 'item_id': id,'modulo_id':{{$modulo->id}} ,'_token': '{{ csrf_token() }}'},
            success: function(){
                $('#anexo'+id).remove();
            }
        });
    }


    function delete_artigo(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/modulo_conteudo') }}/"+id,
            data:  {'tipo': 'artigo', 'item_id': id,'modulo_id':{{$modulo->id}} ,'_token': '{{ csrf_token() }}'},
            success: function(){
                $('#artigo'+id).remove();
            }
        });
    }


    function delete_link(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/modulo_conteudo') }}/"+id,
            data:  {'tipo': 'link', 'item_id': id,'modulo_id':{{$modulo->id}} ,'_token': '{{ csrf_token() }}'},
            success: function(){
                $('#link'+id).remove();
            }
        });
    }

    function delete_video(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/modulo_conteudo') }}/"+id,
            data:  {'tipo': 'video', 'item_id': id,'modulo_id':{{$modulo->id}} ,'_token': '{{ csrf_token() }}'},
            success: function(){
                $('#video'+id).remove();
            }
        });
    }

    function delete_teste(id){
        $.ajax({
            type: "DELETE",
            url: "{{ URL::to('/modulo_conteudo') }}/"+id,
            data:  {'tipo': 'teste', 'item_id': id,'modulo_id':{{$modulo->id}} ,'_token': '{{ csrf_token() }}'},
            success: function(){
                $('#teste'+id).remove();
            }
        });
    }




    function reload(){
        location.reload();
    }


</script>
