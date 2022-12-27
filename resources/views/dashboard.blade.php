<x-app-layout>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif



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

                <div class="d-flex justify-content-center mb-5">
                    <div class="titulo faq-titulo">
                        <b>GUIA DE ACESSO DA PLATAFORMA JOBCREATORS</b>
                    </div>
                </div>

                <div class="d-flex justify-content-start mt-5">
                    <div class="faq-sub">
                        <b>Como acessar a plataforma?</b>
                    </div>
                </div>


                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <i class="fa fa-arrow-right" ></i> <b class="orange">Você receberá um email</b>  te convidando para realizar o primeiro login na
                        plataforma (não esqueça de verificar o seu spam, ok?).
                    </div>
                </div>

                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <i class="fa fa-arrow-right" ></i> <b class="orange"> É importante reforçar,</b>  não tente logar na plataforma com um endereço de email diferente, para você ter acesso, o email de login deve ser igual ao qual foi enviado o
                        convite de acesso a JobCreators.
                    </div>
                </div>

                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <i class="fa fa-arrow-right" ></i> Após o primeiro login, você pode acessar o nosso site <a class="orange-color" href="https://jobcreators.work/login"> https://jobcreators.work/</a> e clicar em “login” para ter acesso a sua jornada.
                    </div>
                </div>

                <div class="d-flex justify-content-start mt-5">
                    <div class="faq-sub">
                        <b>Como acessar as videoaulas da minha jornada?</b>
                    </div>
                </div>



                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <i class="fa fa-arrow-right" ></i>  Você poderá acessar as videoaulas de 3 formas, mas é importante reforçar que para avançar nos módulos, você deve assistir no mínimo 90% de cada conteúdo.

                    </div>
                </div>

                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <b class="white-b-orange">1.</b> Após realizar o seu login, aparecerá uma tela para que você já possa iniciar a sua
                        jornada ou então retomar do ponto em que parou desde o seu último acesso.
                    </div>
                </div>


                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <b class="white-b-orange">2.</b>  Ao fechar a tela anterior, você pode acessar a sua jornada novamente através do
                        caminho: <b class="orange">Minha Journey -> Minha Carreira -> Entrar na Journey</b>
                    </div>
                </div>


                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <b class="white-b-orange">3.</b> Após entrar na Journey, você terá acesso a sua jornada.
                    </div>
                </div>


                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        <b class="white-b-orange">4.</b> Ao fechar a tela de jornada inicial, você pode acessar a sua jornada novamente através
                        do botão localizado ao lado direito da sua tela inicial. Após clicar em Offboarding, você
                        deverá clicar em continuar para retomar ou iniciar a sua jornada.
                    </div>
                </div>


                <div class="d-flex justify-content-start mt-5">
                    <div class="faq-sub">
                        <b>Como acessar os materiais de apoio?</b>
                    </div>
                </div>

                <div class="d-flex justify-content-start mb-5 mt-2">
                    <div class="faq-text">
                        Os materiais de apoio estão disponíveis dentro da plataforma e você poderá acessá-los a qualquer momento durante a sua jornada. Além de acessar os materiais, você pode baixá-los para utilizar durante o seu processo de recolocação profissional.

                    </div>
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
