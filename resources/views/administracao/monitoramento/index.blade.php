<x-app-layout>
    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Monitoramento</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div class="card-body">
                                <div id="instrumentos" class="mb-4" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                        </div>
                                    </div>
                                </div>
                                <div id="grafico">
                                    <canvas id="myChart" height="60rem"></canvas>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn salvar" onclick="detalhes()">+ Detalhes</button>
                                    </div>
                                </div>
                                <div id="content" style="display: none">
                                    @foreach($usuarios as $user)
                                        <div class="row mb-2">
                                            <div class="card col-md-4" style="padding: 0;">
                                                <div class="card-header">
                                                    <b>Nome: </b> {{$user->name}}
                                                </div>
                                                <div class="card-body">
                                                    <div class="flex mb-3">
                                                        <div class="col-md-6">
                                                            Primeiro acesso:
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($user->primeiro_acesso)
                                                                {{ Carbon\Carbon::parse($user->primeiro_acesso)->format('d/m/Y') ?? ''}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="flex">
                                                        <div class="col-md-6">
                                                            Último acesso:
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($user->ultimo_acesso)
                                                                {{ Carbon\Carbon::parse($user->ultimo_acesso)->format('d/m/Y') ?? ''}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card col-md-8" style="padding: 0;">
                                                <div class="card-header">
                                                    <b>Journeys</b>
                                                </div>
                                                @foreach($user->journey as $jornada)
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                {{$jornada->titulo  ?? ''}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-orange" role="progressbar" style="width: {{$jornada->pivot->percentual_concluido ?? 00}}%" aria-valuenow="{{$jornada->pivot->percentual_concluido ?? 00}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                {{$jornada->pivot->percentual_concluido  ?? 00}}%
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                    {{$usuarios->links() ?? ''}}
                                        <div class="d-flex justify-content-end">
                                            <button class="btn salvar" onclick="grafico()"> - Grafico</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">

    var inseridos = {{$inseridos}};
    var acessos = {{$acessos}};


    const data = {
        labels: ['Total de Usuarios inseridos', 'Quantidade de acessos'],
        datasets: [{
            data: [inseridos, acessos],
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    function detalhes(){
        $('#content').show();
        $('#grafico').hide();
    }

    function grafico(){
        $('#content').hide();
        $('#grafico').show();
    }


</script>
