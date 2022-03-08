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
                        <span >Descobrir</span>
                    </button>
                </form>
                @if ($errors->any())
                <span class="error-txt">preencha o campo acima</span>
                @endif
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
                                <tr>
                                    <td>domain.name_url</td>
                                    <td>domain.time_search</td>
                                    <td >FUNCIONANDO NORMALMENTE</td>
                                </tr>
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
