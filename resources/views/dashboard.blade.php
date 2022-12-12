<x-app-layout>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel"  data-interval="10">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('img/slides/slide_1.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/slides/slide_2.png')}}" class="d-block" alt="">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/slides/slide_3.png')}}" class="d-block" alt="">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/slides/slide_4.png')}}" class="d-block" alt="">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <a href="#" data-bs-toggle="modal" data-bs-target="#FAC" onclick="fac()"  style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;color:#000; background-color: #fff; border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px;
z-index:1000;">
        <i style="margin-top:16px" class="fa fa-question"></i>
    </a>

    <a href="#" data-bs-toggle="modal" data-bs-target="#CentralAtendimento" onclick="mail()" style="position:fixed;width:60px;height:60px;bottom:40px;right:110px;color:#000; background-color: #fff;border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px;
z-index:900;">
        <i style="margin-top:16px" class="fa fa-message"></i>
    </a>
</x-app-layout>
<div class="modal fade" id="CentralAtendimento" tabindex="-1" aria-labelledby="CentralAtendimentoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Central de Atendimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                Como Podemos te ajudar?
                <hr class="mb-3">
                <form action="{{route('central-atendimento.send')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="assunto"  class="form-label">Assunto</label>
                        <x-text-input id="assunto" style="width: 100%" type="text" name="assunto" />
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea name="mensagem" rows="8" class="form-control" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn salvar">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="FAC" tabindex="-1" aria-labelledby="FACLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">FAC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">

                <embed src="{{asset('img/slides/guia-acesso.pdf')}}"
                       width="100%"
                       height="700em">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn salvar" data-bs-dismiss="modal">OK </button>
            </div>
        </div>
    </div>
</div>



<script>

    function fac() {

    }
    function mail() {

    }





</script>
