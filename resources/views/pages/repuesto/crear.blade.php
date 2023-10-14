@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar Repuesto</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Repuesto</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header style-warning">
                    <h3 class="card-title">Nuevo Repuesto</h3>
                    <div class="card-tools"></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('repuesto.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="md-form form-group col-12"><!--CODIGO-->
                            <input id="codigo" name="codigo" required placeholder="Digite codigo"
                                class="form-control form-control-sm" rows="3">
                            <small id="helpId" class="text-muted">Campo Obligatorio</small>
                        </div>

                        <div class="form-group col-12"><!--SUBCATEGORIA-->
                            <select required class="form-control form-control-sm select2" name="idTipoRepuesto"
                                style="width: 100%;">
                                @foreach (@tipos() as $tip)
                                    <option value="{{ $tip->id }}">{{ $tip->tipo }}</option>
                                @endforeach
                            </select>
                            <small id="helpId" class="text-muted">Seleccione una SubCategoria (Campo Obligatorio)</small>
                        </div>

                        <div class="form-group col-12"><!--CATEGORIA-->

                            <select required class="form-control form-control-sm select2" name="idCategoria"
                                style="width: 100%;">
                                @foreach (@categorias() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                            <small id="helpId" class="text-muted">Seleccione una Categoria (Campo Obligatorio)</small>

                        </div>

                        <div class="form-group col-12"><!--MARCA-MODELO-->

                            <select class="form-control form-control-sm select2" name="idMarcaModelo" style="width: 100%;">
                                @foreach ($marcasModelos as $marMod)
                                    <option value="{{ $marMod->id }}">{{ @nombreMarca($marMod->id) }} -
                                        {{ @nombreModelo($marMod->id) }} - {{ $marMod->submedida }} - {{ $marMod->medida }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="helpId" class="text-muted">Seleccione una Marca (Campo Obligatorio)</small>

                        </div>

                        <div class="col-md-3 col-md-12"><!--PRECIO VENTA-->
                            <div class="form-group">
                                <input name="precioVenta" type="float" class="form-control form-control-sm"
                                    id="precioVenta">
                                <small id="helpId" class="text-muted">Digite el Precio de Venta (Campo Obligatorio)</small>
                            </div>
                        </div>

                        {{-- <div class="col-md-12"><!--PRECIO COMPRA-->
                            <div class="form-group">
                                <input name="precioCompra" type="float" class="form-control form-control-sm"
                                    id="precioVenta">
                                <small id="helpId" class="text-muted">Digite el Precio de Compra (Campo Obligatorio)</small>
                            </div>
                        </div> --}}

                        <div class="md-form form-group col-12"><!-- DESCRIPCION-->
                            <i class="fas fa-pencil-alt prefix"></i>
                            <textarea id="form10" required name="descripcion" class="md-textarea form-control"
                                rows="3"></textarea>
                            <small id="helpId" class="text-muted">Escriba una descripcion (Campo Obligatorio)</small>
                        </div>

                        <div class="col-md-12"> <!--IMAGEN-->
                            <div class="form-group">
                                <label>Seleccione Imagen</label>
                                <input type="file" required id="imgInp" name="imagen" class="form-control form-control-sm">
                                <small id="helpId" class="text-muted">Seleccione una imagen (Campo Obligatorio)</small>
                            </div>
                        </div>

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
