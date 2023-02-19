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
                        <i class="fa fa-align-justify"></i> List Penerbit
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th style="text-align: center;">Action</th>
                                        <th>Nama Penerbit</th>
                                        <th>Alamat</th>
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
                                                    <a class="btn btn-warning" href="{{ route('penerbit.edit',$row->id) }}" class="text-info border-gray border-right pr-2"><i class="fas fa-pen"></i></a>&nbsp;
                                                    <br>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-confirm" data-id="{{ $row->id }}" tooltip="Delete"><i class="cil-trash"></i></button>
                                                </div>
                                            </td>
                                            <td style="vertical-align:middle;">{{ $row->nama}}</td>
                                            <td style="vertical-align:middle;">{{ $row->alamat }}</td>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Tambah Penerbit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('penerbit.store')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="text-input">Nama Penerbit</label>
                        <input class="form-control" type="text" name="nama" placeholder="Enter Nama Penerbit.." required><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Alamat</label>
                        <input class="form-control" type="text" name="alamat" placeholder="Enter Jenis Alamat.." required><span class="help-block"></span>
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
                    url: "penerbit/"+id,
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