@extends('index')
@section('contenido')

    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Actualizar Repuesto</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Repuestos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header style-warning">
                    <h3 class="card-title">Modificar Repuesto</h3>
                    <div class="card-tools"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('repuesto.update', ['id' => $repuesto->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="md-form form-group col-12"><!--CODIGO-->
                            <input id="codigo" required name="codigo" value="{{ $repuesto->codigo }}"
                                class="form-control form-control-sm" rows="3">
                            <small id="helpId" class="text-muted">Escriba un codigo del Repuesto (Campo Obligatorio)</small>
                        </div>

                        <div class="form-group col-12"><!--SUBCATEGORIA-->
                            <select class="form-control select2 form-control-sm" required name="idTipoRepuesto" style="width: 100%;">
                                @foreach (@tipos() as $tip)
                                    <option value="{{ $tip->id }}">{{ $tip->tipo }}</option>
                                @endforeach
                            </select>
                            <small id="helpId" class="text-muted">Seleccione una SubCategoria (Campo Obligatorio)</small>
                        </div>

                        <div class="form-group col-12"><!--CATEGORIA-->
                            <select class="form-control form-control-sm select2" required name="idCategoria" style="width: 100%;">
                                @foreach (@categorias() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                            <small id="helpId" class="text-muted">Seleccione una Categoria (Campo Obligatorio)</small>
                        </div>

                        <div class="form-group col-12"><!--MARCA-MODELO-->
                            <select class="form-control form-control-sm select2" required name="idMarcaModelo"
                                style="width: 100%;">
                                @foreach ($marcasModelos as $marMod)
                                    <option value="{{ $marMod->id }}">{{ @nombreMarca($marMod->id) }} -
                                        {{ @nombreModelo($marMod->id) }} - {{ $marMod->submedida }} -
                                        {{ $marMod->medida }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="helpId" class="text-muted">Seleccione una Marca - Modelo (Campo Obligatorio)</small>
                        </div>

                        <div class="col-md-3 col-md-12"><!--PRECIO VENTA-->
                            <div class="form-group">
                                <input required name="precioVenta" type="float" value="{{ $repuesto->precioVenta }}"
                                    class="form-control form-control-sm" id="precioVenta">
                                <small id="helpId" class="text-muted">Digite el Precio de Venta (Campo Obligatorio)</small>

                            </div>
                        </div>

                    

                        <div class="md-form form-group col-12"> <!--DESCRIPCION-->
                            <label for="form10">Descripcion</label>
                            <i class="fas fa-pencil-alt prefix"></i>
                            <textarea id="form10" name="descripcion" class="md-textarea form-control" rows="3"
                                placeholder="{{ $repuesto->descripcion }}"></textarea>
                            <small id="helpId" class="text-muted">Escriba una descripcion (Campo Obligatorio)</small>

                        </div>

                        <div class="col-md-12"><!--IMAGEN-->
                            <div class="form-group">
                                <input type="file" name="imagen" class="form-control form-control-sm">
                                <small id="helpId" class="text-muted">Seleccione una imagen (Campo Obligatorio)</small>
                            </div>
                        </div>
                        <img src="{{ asset($repuesto->imagen) }}" width="100" height="100" alt="">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection
