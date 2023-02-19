@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                @if(Auth::user()->role === 'user')
                <div class="position-relative">
                    <button type="button" class="btn btn-primary active" aria-pressed="true" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Pinjam </button>
                </div>
                <br>@endif
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
                        <i class="fa fa-align-justify"></i> List Peminjaman Buku
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="vertical-align:middle;text-align: center;">No</th>
                                        @if(Auth::user()->role === 'admin')
                                        <th style="vertical-align:middle;text-align: center;">Action</th>
                                        @endif
                                        <th style="vertical-align:middle;text-align: center;">Status</th>
                                        <th style="vertical-align:middle;">Judul Buku</th>
                                        <th style="vertical-align:middle;">Tanggal Pinjam</th>
                                        @if(Auth::user()->role === 'admin')
                                        <th style="vertical-align:middle;">Nama Peminjam</th>
                                        @endif
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
                                            @if(Auth::user()->role === 'admin')
                                            <td>
                                                <div style="text-align:center; vertical-align:middle;">         
                                                    @if($row->status === 'approved')
                                                    <button type="button" class="btn btn-warning btn-md mr-1 btn-return"  data-return="{{$row->id}}" tooltip="Buku Sudah Dikembalikan"><i class="cil-reload"></i></button>
                                                    @elseif($row->status === 'request')                                       
                                                    <button type="button" class="btn btn-success btn-md mr-1 btn-approve"  data-approve="{{$row->id}}" tooltip="Approve Request Peminjaman"><i class="cil-check"></i></button>
                                                    @else
                                                    <button type="button" class="btn btn-warning btn-md mr-1" disabled><i class="cil-reload"></i></button>
                                                    <button type="button" class="btn btn-success btn-md mr-1" disabled><i class="cil-check"></i></button>
                                                    @endif
                                                </div>
                                            </td>
                                            @endif
                                            <td style="text-align:center; vertical-align:middle;">
                                                @if($row->status == 'request')
                                                    <span class="badge badge-danger"> Request</span>
                                                @elseif($row->status == 'approved')
                                                    <span class="badge badge-success"> Approved</span>
                                                @else($row->status == 'done')
                                                    <span class="badge badge-info"> Done</span>
                                                @endif
                                            </td>
                                            <td style="vertical-align:middle;">{{ $row->buku->nama}}</td>
                                            <td style="vertical-align:middle;">{{ $row->created_at }}</td>
                                            @if(Auth::user()->role === 'admin')
                                            <td style="vertical-align:middle;">{{ $row->user->name }}</td>  
                                            @endif                                          
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
                <h5 class="modal-title" id="addModal">Request Peminjaman Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('peminjaman-buku.store')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="text-input">Judul</label>
                        <select class="form-control" name="buku_id" id="buku_id">
                            <option value="" disabled selected>-- Choose --</option>
                            @foreach($buku as $row)
                                <option value="{{$row->id}}">{{$row->nama. ' - '. $row->pengarang->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Nama Penertbit</label>
                        <input class="form-control" type="text" id='penerbit' readonly><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Nama Pengarang</label>
                        <input class="form-control" type="text" id='pengarang' readonly><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Genre</label>
                        <input class="form-control" type="text" id='genre' readonly><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Tahun Terbit</label>
                        <input class="form-control" type="text" id='tahun' readonly><span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Sinopsis</label>
                        <br>
                        <textarea class="form-control" id='sinopsis' name="sinopsis" cols="68" rows="5" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="text-input">Status</label>
                        <input class="form-control" type="text" id='status' readonly><span class="help-block"></span>
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
    $('#buku_id').on('change', function(e) {
        let id = $('#buku_id option:selected').val();
        getDetaildBuku(id);
    });

    function getDetaildBuku(id){
        $.ajax({
            type: 'GET',
            url: 'buku/'+id,
            success: function(data) {
                $('#penerbit').val(data.penerbit.nama);
                $('#pengarang').val(data.pengarang.nama);
                $('#genre').val(data.genre);
                $('#tahun').val(data.tahun);
                $('#sinopsis').val(data.sinopsis);
                $('#status').val(data.status);
            }
        });
    }

    $('.btn-approve').on('click', function (event) {
        event.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        var id = $(this).data('approve');
        var token = $("meta[name='csrf-token']").attr("content");
        swal({
            title: 'Setujui Peminjaman Buku?',
            icon: 'warning',
            buttons: ["Cancel", "Submit"],
    }).then(function(isConfirm) {
    if (isConfirm) {
        $.ajax({
            url: "approve/peminjaman/"+id,
            type: 'post',
            dataType: 'json',
            beforeSend: function(xhr) {
                $('.loading').removeClass('d-none');
            },
            data: { 
                "_token": token,
                submit: true},
        })
        .done(function( data ) {
            swal("Awesome!", data.message, "success");
            location.reload();
        })
        .error(function( data ) {
            swal("Oops...", data.responseJSON.message, "error");
        }); 
    }else{
            swal("Cancelled", "Batal Approve Data", "error");
        }
    });
    });

    $('.btn-return').on('click', function (event) {
        event.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        var id = $(this).data('return');
        var token = $("meta[name='csrf-token']").attr("content");
        swal({
            title: 'Buku Sudah DiKembalikan?',
            icon: 'warning',
            buttons: ["Cancel", "Submit"],
    }).then(function(isConfirm) {
    if (isConfirm) {
        $.ajax({
            url: "return/peminjaman/"+id,
            type: 'post',
            dataType: 'json',
            beforeSend: function(xhr) {
                $('.loading').removeClass('d-none');
            },
            data: { 
                "_token": token,
                submit: true},
        })
        .done(function( data ) {
            swal("Awesome!", data.message, "success");
            location.reload();
        })
        .error(function( data ) {
            swal("Oops...", data.responseJSON.message, "error");
        }); 
    }else{
            swal("Cancelled", "Batal Update Data", "error");
        }
    });
    });
</script>
@endsection