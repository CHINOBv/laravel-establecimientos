@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/opencagedata/leaflet-opencage-search@1.4.1/dist/css/L.Control.OpenCageData.Search.min.css" />

@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mt-4">
            Registrar Establecimiento
        </h1>
        <div class="mt-5 row justify-content-center">
            <form class='col-md-9 col-xs-12 card card-body'>
                @csrf
                <fieldset class='border p-4'>
                    <legend class='text-primary'>Nombre, Categoria e Imagen principal</legend>
                    <div class="form-group">
                        <label for="nombre">Nombre Establecimiento</label>
                        <input
                            type="text"
                            class="form-control
                                @error('nombre')
                                    is-invalid
                                @enderror "
                            id='nombre'
                            name='nombre'
                            placeholder='Nombre del establecimiento...'
                            value="{{@old('nombre')}}"
                        >
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select
                            name="categoria_id"
                            id="categoria"
                            class='form-control
                            @error('categoria_id')
                                is-invalid
                            @enderror
                            '
                        >
                            <option value="" selected disabled>--Selecciona una categoria--</option>
                            @foreach ($categorias as $categoria)
                                <option
                                    value="{{$categoria->id}}"
                                    {{old('categoria_id') == $categoria->id ? 'selected' : ''}}
                                > {{$categoria->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagen_principal">Imagen principal</label>
                        <input
                            type="file"
                            class="form-control
                                @error('imagen_principal')
                                    is-invalid
                                @enderror "
                            id='imagen_principal'
                            name='imagen_principal'
                        >
                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class='border p-4'>
                    <legend class='text-primary'>Ubicacion</legend>
                    <div class="form-group">
                        <label for="formbuscador">Coloca la direccion de tu establecimiento</label>
                        <input
                            type="text"
                            class="form-control"
                            id='formbuscador'
                            placeholder='Calle del negocio o establecimiento'
                        >
                        <p class="text-secondary mt-5 mb-3 text-center">El asistente colocara una ubicacion estimada mueve el pin al lugar que deseas</p>
                    </div>
                    <div class="form-group">
                        <div id="mapa" style="height: 400px;">
                        </div>
                    </div>
                    <p>Confirma que los siguientes campos son correctos</p>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input
                            type="text"
                            id='direccion'
                            placeholder='Direccion del establecimiento...'
                            value="{{old('direccion')}}"
                            class="form-control
                                @error('direccion')
                                    is-invialid
                                @enderror
                            "
                        >
                        @error('direccion')
                            <p class='invalid-feedback'>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="colonia">Colonia</label>
                        <input
                            type="text"
                            id='colonia'
                            placeholder='Colonia del establecimiento...'
                            value="{{old('colonia')}}"
                            class="form-control
                                @error('colonia')
                                    is-invialid
                                @enderror
                            "
                        >
                        @error('colonia')
                            <p class='invalid-feedback'>{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="lat" id='lat' value={{old('lat')}} >
                    <input type="hidden" name="lng" id='lng' value={{old('lng')}} >
                </fieldset>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/opencagedata/leaflet-opencage-search@1.4.1/dist/js/L.Control.OpenCageSearch.min.js"></script>

@endsection
