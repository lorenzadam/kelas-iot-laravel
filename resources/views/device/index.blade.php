@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-4 d-flex justify-content-between align-items-center">
            <h2>Data Device</h2>
            <a href="/devices/create" class="btn btn-primary">Tambah</a>
        </div>

        <div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Serial Number</th>
                        <th>Meta Data</th>
                        <th style="text-align: center;">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $device->serial_number }}</td>
                            <td>{{ $device->meta_data }}</td>
                            <td>
                                <div class="d-flex g-2 justify-content-center align-items-center">
                                    <a href="/devices/edit/{{ $device->id }}" class="btn btn-sm btn-warning">
                                        Ubah
                                    </a>
                                    <form action="/devices/delete/{{ $device->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ms-2 btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
