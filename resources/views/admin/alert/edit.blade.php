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
        <div class="container form">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                            action="{{route('alert.update',$servers->id)}}">
                            @csrf @method("PUT")
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Dominio</label>
                                                <input type="text" id="first-name-vertical"
                                                    class="form-control" name="url_name"
                                                    placeholder="exemplo.com">
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1">Confirmar</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">limpar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--container-->
    </div>
@include("template.footer")
