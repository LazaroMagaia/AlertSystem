@include("template.header")
@include('layouts.navigation')
<div class="Alert container">
    <div class="show_alert">
        <div class="admin-home-top">
            <div class="single-wrapper">
                <div>
                    @if(isset($down))
                        <p>{{$down->down_count}}</p> <span>Quedas</span>
                    @else
                    <p>0</p> <span>Quedas</span>
                    @endif
                </div>
                <div>
                    <i class="bi bi-x-octagon-fill"></i>
                </div>
            </div><!--single-wrapper-->
            <div class="single-wrapper">
                <div>
                    <p>2</p> <span>Nome</span>
                </div>
                <div>
                    <i class="bi bi-people-fill"></i>
                </div>
            </div><!--single-wrapper-->
        </div>
    </div>
    <div class="title-alert-show-estatistic">
         <h1>Estatisticas</h1>
    </div><!--estatistic-->

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
                                    <th>Quando ficou fora do ar</th>
                                    <th>Quando retornou</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$server->url_name}}</td>
                                    <td>{{date('m-d-Y H:i:s', strtotime($server->date_time_reset))}}</td>
                                    <td>
                                        @if(isset($downUpServer))
                                        @if($server->date_down)
                                        <p>{{date('m-d-Y H:i:s', strtotime($server->date_down))}}</p>
                                        @else
                                        <p>---</p>
                                        @endif
                                        @else
                                        <p>---</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($server->date_up)
                                        <p>{{date('m-d-Y H:i:s', strtotime($server->date_up))}}</p>
                                        @else
                                        <p>---</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Borderless table end -->
</div>
@include("template.footer");
