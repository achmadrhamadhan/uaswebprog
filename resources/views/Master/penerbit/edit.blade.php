@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>Form Edit</strong> Penerbit</div>
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
                        <form method="post" action="{{ route('penerbit.update', $data->id) }}" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Nama Penerbit</label>
                                    <input class="form-control" type="text" name="nama" value="{{ $data->nama }}" placeholder="Enter Nama Penerbit.." required><span class="help-block"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Alamat</label>
                                    <input class="form-control" type="text" name="alamat" value="{{ $data->alamat }}" placeholder="Enter Nama Penerbit.." required><span class="help-block"></span>
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