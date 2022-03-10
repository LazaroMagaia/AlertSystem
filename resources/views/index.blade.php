@include('template.header')
@include("template.navbar")
<div class='home'>
    @if ($errors->any())
    <ol class="errors">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ol>
    @endif
    <div class='container'>
        <div class='banner-principal'>
            <div class='desc'>
                <h3>O meu site esta offline ?</h3>
                <p>Caiu para todos ou so para mim</p>
                <form action="{{route('domain.index')}}" method="POST">
                @csrf
                    <input type="text" name="domain" value="{{old('domain')}}"
                    placeholder="exemplo.co.mz">
                    <button type="submit">
                        <span>Descobrir</span>
                    </button>
                </form>
                @if ($errors->any())
                <span class="error-txt">preencha o campo acima</span>
                @endif
            </div>
            <div class='server-response'>
                @if(session('mensagem'))
                @if(session('response') == true)
                    <div>
                        <div class="response">
                            <p>Esta tudo certo</p>imagem
                        </div>
                        <span>Esta tudo normal por aqui</span>
                    </div>
                    @else
                    <div>
                        <div class="response">
                        <p>Realmente esta fora</p>
                        imagem
                        </div>
                        <span>Não conseguimos acessar o seu site</span>
                    </div>
                    @endif
                @endif

                <!--
                <div v-if="erros === true">
                    <p>Não conseguimos acessar o site</p>
                    <span>tem certeza que é esse o dominio ?</span>
                </div>
            -->
            </div>
        </div>
    </div>
</div><!--home-->
<div class='mais-vistos container'>
    <h3>Ultimas consultas realizadas</h3>
    <!-- Borderless table start -->
</div>
<section class="section container">
    <div class="row" id="table-borderless">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <!-- table with no border -->
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead>
                                <tr style="text-transform:uppercase;">
                                    <th>Dominio(url)</th>
                                    <th>Ultima verificacao</th>
                                    <th>Status do site</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servers as $server)
                                    <tr>
                                        <td>{{$server->name_url}}</td>
                                        <td>{{date('m-d-Y H:i:s', strtotime($server->time_search))}}</td>
                                        @if ($server->status)
                                        <td>FUNCIONANDO NORMALMENTE</td>
                                        @else
                                        <td>FORA DO AR</td>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@include('template.footer')
