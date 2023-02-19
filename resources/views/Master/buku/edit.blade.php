@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>Form Edit</strong> Buku</div>
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
                        <form method="post" action="{{ route('buku.update', $data->id) }}" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Nama Penertbit</label>
                                    <select class="form-control" name="penerbit_id" required><span class="help-block"></span>            
                                        @foreach ($penerbit as $val)
                                            <option value="{{ $val->id }}" {{ $data->penerbit_id == $val->id ? 'selected="selected"' : ''}}>{{ $val->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Judul</label>
                                    <input class="form-control" type="text" name="nama" value="{{$data->nama}}" placeholder="Enter Judul.." required><span class="help-block"></span>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Nama Pengarang</label>
                                    <select class="form-control" name="pengarang_id" required><span class="help-block"></span>            
                                        @foreach ($pengarang as $val)
                                            <option value="{{ $val->id }}" {{ $data->pengarang_id == $val->id ? 'selected="selected"' : ''}}>{{ $val->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Genre</label>
                                    <select class="form-control" name="genre" required><span class="help-block"></span>
                                        <option value="" disabled selected>-- Choose --</option>
                                        <option value="fiksi" {{ $data->genre == 'fiksi' ? 'selected="selected"' : '' }}> Fiksi</option>
                                        <option value="novel" {{ $data->genre == 'novel' ? 'selected="selected"' : '' }}> Novel</option>
                                        <option value="religi" {{ $data->genre == 'religi' ? 'selected="selected"' : '' }}> Religi</option>
                                        <option value="bisnis" {{ $data->genre == 'bisnis' ? 'selected="selected"' : '' }}> Bisnis</option>
                                        <option value="self-improvement" {{ $data->genre == 'self-improvement' ? 'selected="selected"' : '' }}> Self-Improvement</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="form-group col-sm-6">
                                    <label for="text-input">Status</label>
                                    <select class="form-control" name="status" required><span class="help-block"></span>
                                        <option value="" disabled selected>-- Choose --</option>
                                        <option value="available" {{ $data->status == 'available' ? 'selected="selected"' : '' }}> Available</option>
                                        <option value="rented" {{ $data->status == 'rented' ? 'selected="selected"' : '' }}> Rented</option>
                                        <option value="broken" {{ $data->status == 'broken' ? 'selected="selected"' : '' }}> Broken</option>
                                    </select>                             
                                </div>
                                <div class="form-group col-sm-6">   
                                    <label for="text-input">Tahun Terbit</label>
                                    <input class="form-control" type="number" name="tahun" value="{{$data->tahun}}" placeholder="Enter Tahun.." required><span class="help-block"></span>                           
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                <label for="text-input">Sinopsis</label>
                                <textarea class="form-control" name="sinopsis" cols="68" rows="5"  required>{{ $data->sinopsis }}</textarea>    
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