@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <div class="position-relative">
                    <button type="button" class="btn btn-primary active" aria-pressed="true" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Create </button>
                </div>
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> List Buku
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="vertical-align:middle;">No</th>
                                        <th style="vertical-align:middle;text-align: center;">Action</th>
                                        <th style="vertical-align:middle;">Penertbit</th>
                                        <th style="vertical-align:middle;">Pengarang</th>
                                        <th style="vertical-align:middle;">Judul</th>
                                        <th style="vertical-align:middle;">Genre</th>
                                        <th style="vertical-align:middle;">Tahun Terbit</th>
                                        <th style="vertical-align:middle;">Sinopsis</th>
                                        <th style="vertical-align:middle;">Status</th>
                                    </tr>
                                </thead>
                                @if (count($data) <= 0) 
                                    <tr>
                                        <td colspan="9" class="text-center">Data Empty</td>
                                    </tr>
                                @else
                                    <?php $no = 1; ?>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                            <td class="text-center">{{$no}}</td>
                                            <td>
                                                <div style="text-align:center; vertical-align:middle;">                                                
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-warning" href="{{ route('buku.edit',$row->id) }}" class="text-info border-gray border-right pr-2"><i class="fas fa-pen"></i></a>&nbsp;
                                                    <br>
                                                    <button type="button" class="btn btn-danger delete-confirm" data-id="{{ $row->id }}" tooltip="Delete"><i class="cil-trash"></i></button>
                                                </div>
                                            </td>
                                            <td style="vertical-align:middle;">{{ $row->penerbit->nama}}</td>
                                            <td style="vertical-align:middle;">{{ $row->pengarang->nama }}</td>
                                            <td style="vertical-align:middle;">{{ $row->nama }}</td>
                                            <td style="vertical-align:middle;">{{ $row->genre }}</td>
                                            <td style="vertical-align:middle;">{{ $row->tahun }}</td>
                                            <td style="vertical-align:middle;">{{ $row->sinopsis }}</td>
                                            <td style="vertical-align:middle;">
                                                @if($row->status == 'available')
                                                    <span class="badge badge-info"> Available</span>
                                                @elseif($row->status == 'rented')
                                                    <span class="badge badge-danger"> Rented</span>
                                                @else($row->status == 'broken')
                                                    <span class="badge badge-warning"> Broken</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                        @endforeach
                                @endif
                                    </tbody>
                            </table>
                            {{ $data->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('buku.store')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="text-input">Nama Penertbit</label>
                        <select class="form-control" name="penerbit_id" required><span class="help-block"></span>
                            <option value="" disabled selected>-- Choose --</option>
                            @foreach ($penerbit as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Nama Pengarang</label>
                        <select class="form-control" name="pengarang_id" required><span class="help-block"></span>
                            <option value="" disabled selected>-- Choose --</option>
                            @foreach ($pengarang as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Judul</label>
                        <input class="form-control" type="text" name="nama" placeholder="Enter Judul.." required><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Genre</label>
                        <select class="form-control" name="genre" required><span class="help-block"></span>
                            <option value="" disabled selected>-- Choose --</option>
                            <option value="fiksi"> Fiksi</option>
                            <option value="novel"> Novel</option>
                            <option value="religi"> Religi</option>
                            <option value="bisnis"> Bisnis</option>
                            <option value="self-improvement"> Self-Improvement</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Tahun Terbit</label>
                        <input class="form-control" type="number" name="tahun" placeholder="Enter Tahun.." required><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Sinopsis</label>
                        <br>
                        <textarea class="form-control" name="sinopsis" cols="68" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Status</label>
                        <select class="form-control" name="status" readonly>
                            <option value="available" selected>Available</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        swal({
            title: 'Apa kamu yakin?',
            text: 'Data ini akan di hapus permanent!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "buku/"+id,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        "id": id,
                        "_token": token,
                        method: '_DELETE',
                        submit: true},
                }).done(function( data ) {
                    swal("Awesome!", data.message, "success");
                    location.reload();
                })
                .error(function( data ) {
                    swal("Oops...", data.responseJSON.message, "error");
                }); 
            }else{
                    swal("Batal", "Data tidak jadi dihapus :)", "error");
            }
        });
    });
</script>
@endsection