<form action="{{ route('almacen.index') }}" method="GET" autocomplete="off" role="search">
     <div class="input-group-prepend">
         <input  type="text" class="form-control form-control-sm" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
         <button  class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
     </div>
 </form>