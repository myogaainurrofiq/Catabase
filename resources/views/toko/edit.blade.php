@extends('toko.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Kucing</h5>

		<form method="post" action="{{ route('toko.update', $data->id_kucing) }}">
			@csrf
            <div class="mb-3">
                <label for="id_kucing" class="form-label">ID Kucing</label>
                <input type="text" class="form-control" id="id_kucing" name="id_kucing"> 
                <!-- value="{{$data->id_kucing}}"> -->
            </div>
            <div class="mb-3">
                <label for="warna" class="form-label">Warna Kucing</label>
                <input type="text" class="form-control" id="warna" name="warna">
            </div>
            <div class="mb-3">
                <label for="usia" class="form-label">Usia Kucing</label>
                <input type="text" class="form-control" id="usia" name="usia">
            </div>
            <div class="mb-3">
                <label for="id_ras" class="form-label">ID Ras</label>
                <input type="text" class="form-control" id="id_ras" name="id_ras">
            </div>
            <div class="mb-3">
                <label for="id_toko" class="form-label">ID Toko</label>
                <input type="text" class="form-control" id="id_toko" name="id_toko">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop
