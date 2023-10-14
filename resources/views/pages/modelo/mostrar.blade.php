@extends('index')
@section('contenido')
  <div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h3 class="m-0">Registrar Modelos</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Modelo</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
          <div class="card-header">
            @include('pages.modelo.insertar')
            <h3 class="card-title"></h3>
            <div class="card-tools">
              @include('pages.modelo.buscar')
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <thead class="style-warning">
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($modelos as $modelo)
                  <tr>
                      <td>{{ $modelo->id }}</td>
                      <td>{{ $modelo->nombre }}</td>
                      <td>
                        @include('pages.modelo.actualizar')
                        @include('pages.modelo.eliminar')
                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{ $modelos->links()}}
    </div>
  </section>
@endsection
