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
                                    <span class="badge bg-primary rounded-pill">{{count($anexos)}}</span>

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
                                    <span class="badge bg-primary rounded-pill">{{count($artigos)}}</span>

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
                                    <span class="badge bg-primary rounded-pill">{{count($links)}}</span>

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
                                    <span class="badge bg-primary rounded-pill">{{count($videos)}}</span>

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
                                    <span class="badge bg-primary rounded-pill">{{count($testes)}}</span>

                                </li>









                            </ul>


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




</script>
