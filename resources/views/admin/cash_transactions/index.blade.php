@extends('layouts.mazer.app', ['title' => 'Kas', 'page_heading' => 'Data Kas'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addSchoolClassModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
        </div>

        <table class="table table-sm" id="datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>
                        <div class="btn-group" role="group">
                            <div class="mx-1">
                                <button type="button" data-id="#" class="btn btn-primary btn-sm school-class-detail"
                                    data-bs-toggle="modal" data-bs-target="#showSchoolClassModal">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <button type="button" data-id="#" class="btn btn-success btn-sm school-class-edit"
                                    data-bs-toggle="modal" data-bs-target="#editSchoolClassModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <form action="#" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-notification">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('modal')
{{--  --}}
@endpush

@push('js')
{{--  --}}
@endpush