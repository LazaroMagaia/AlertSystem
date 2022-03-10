@include("template.header")
@include('layouts.navigation')
    @if ($errors->any())
    <ol class="errors">
        @foreach ($errors->all() as $error)
            <li class="error text-center">{{$error}}</li>
        @endforeach
    </ol>
    @endif
    <div>
        <div class="row container">
            Modal
        </div><!--row-->
        <div class="Alert container">
            <div class="new_alert">
                    <div class="col-md-6 col-12">
                        <form class="form" method="POST"
                        action="{{route('alert.store')}}">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="url_name-vertical"> Novo Site</label>
                                        <input  id="url_name-vertical" name="url_name"
                                        class="form-control" placeholder="exemplo.com">
                                    </div>
                                    <div class="col-md-6 my-4">
                                        <button class="btn btn-primary me-1 mb-1">
                                            Novo site
                                        </button>
                                    </div><!--col-6-->
                                    <small class="text-danger" v-if="errors.name">
                                        @if($errors->any())
                                        O campo acima não deve estar vazio
                                        @endif
                                    </small>
                                </div>
                        </form>
                    </div>
            </div><!--new_alert-->
                <h3>Meus sites</h3>
            <!-- Borderless table start -->
            <section class="section">
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
                                                <th>Acoes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($servers as $server)
                                            <tr>
                                                <td>{{$server->url_name}}</td>
                                                <td>{{$server->date_time_reset}}</td>
                                                @if ($server->status)
                                                <td>FUNCIONANDO NORMALMENTE</td>
                                                @else
                                                <td>FORA DO AR</td>
                                                @endif
                                                <td class="flex">
                                                    <a href="{{route('alert.edit',$server->id)}}" class="btn btn-primary mx-1">Editar</a>
                                                    <a href="{{route('alert.show',$server->id)}}" class="btn btn-warning mx-1">ver</a>
                                                    <form action="{{route('alert.delete',$server->id)}}" method="POST">
                                                        @csrf @method("DELETE")
                                                        <button class="btn btn-danger mx-1">Remover</button>
                                                    </form>
                                                </td>
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
            <!-- Borderless table end -->
        </div><!--alert-->
    </div>

    <script>

    </script>
@include("template.footer")
