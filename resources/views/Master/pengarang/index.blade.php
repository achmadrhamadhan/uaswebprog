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
                        <i class="fa fa-align-justify"></i> List Pengarang
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th style="text-align: center;">Action</th>
                                        <th>Nama Pengarang</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Negara</th>
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
                                                    <a class="btn btn-warning" href="{{ route('pengarang.edit',$row->id) }}" class="text-info border-gray border-right pr-2"><i class="fas fa-pen"></i></a>&nbsp;
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-confirm" data-id="{{ $row->id }}" tooltip="Delete"><i class="cil-trash"></i></button>
                                                </div>
                                            </td>
                                            <td style="vertical-align:middle;">{{ $row->nama}}</td>
                                            <td style="vertical-align:middle;">{{ $row->jenis_kelamin }}</td>
                                            <td style="vertical-align:middle;">{{ $row->negara }}</td>
                                        </tr>
                                        <?php $no++; ?>
                                        @endforeach
                                @endif
                                    </tbody>
                            </table>
                            {{ $data->links('vendor.pagination.custom') }}
                        <div class="table-responsive">
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
                <h5 class="modal-title" id="addModal">Tambah Pengarang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('pengarang.store')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="text-input">Nama Pengarang</label>
                        <input class="form-control" type="text" name="nama" placeholder="Enter Nama Pengarang.." required><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="laki-laki">laki-laki</option>
                            <option value="perempuan">perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Negara</label>
                        <input class="form-control" type="text" name="negara" placeholder="Enter Negara.." required><span class="help-block"></span>
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
                    url: "pengarang/destroy/"+id,
                    type: 'post',
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