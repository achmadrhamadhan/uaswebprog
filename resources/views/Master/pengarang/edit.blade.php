@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>Form Edit</strong> Pengarang</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ route('pengarang.update', $data->id) }}" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Nama Pengarang</label>
                                    <input class="form-control" type="text" name="nama" value="{{ $data->nama }}" placeholder="Enter Nama Pengarang.." required><span class="help-block"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" {{ $data->jenis_kelamin == 'laki-laki' ? 'selected="selected"' : '' }}>laki-laki</option>
                                        <option value="perempuan" {{ $data->jenis_kelamin == 'perempuan' ? 'selected="selected"' : '' }}>perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Negara</label>
                                    <input class="form-control" type="text" name="negara" value="{{$data->negara}}" placeholder="Enter Negara.." required><span class="help-block"></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-md btn-primary" type="submit"> Submit</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-md btn-danger"> Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection