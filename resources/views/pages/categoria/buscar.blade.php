<form action="{{ route('categoria.index') }}" method="GET" autocomplete="off" role="search">
    <div class="input-group-prepend">
        <input type="text" class="form-control form-control-sm" style="border-radius: 20px" name="searchText"
            placeholder="Buscar cliente" value="{{ $searchText }}">
        <button style="border: none; background: none ; position: relative; right: 17%; " class="btn btn-primary btn-sm"
            type="submit"><i style="color:#ccc" class="fas fa-search"></i>
        </button>
    </div>
</form>
