<x-app-layout>
    <div class="flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Minha Entrevista</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <img src="{{asset('img/entrevista.png')}}">
                        <h1 class="titulo-ma mt-2"><b>Baixe seu guia para entrevistas: </b></h1>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="flex justify-content-between px-5 py-2">
                                    <a class="text-download" href="@if(isset($entrevista)){{route('entrevista.download',$entrevista)}}@else # @endif">  <i class="fa fa-file mr-2"></i>Entrevista - Preparação do Discurso</a>
                                    <a href="#" class="text-download ml-3" data-bs-toggle="modal" data-bs-target="#AdicionarEntrevista" >@if(isset($entrevista))<i class="fa fa-pen"></i> @else <i class="fa fa-upload"></i>@endif </a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



<div class="modal fade" id="AdicionarEntrevista" tabindex="-1" aria-labelledby="AdicionarEntrevistaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Entrevista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('entrevista.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="anexc" class="form-label">Entrevista</label>
                        <input type="file" name="entrevista" class="form-control" required>
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
