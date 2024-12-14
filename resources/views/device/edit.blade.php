@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-4 d-flex justify-content-between align-items-center">
            <h2>Ubah Data Device</h2>
        </div>

        <div>
            <form action="/devices/update/{{ $device->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ $device->serial_number }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <label for="meta_data" class="form-label">Meta Data</label>
                        <input type="text" name="meta_data" id="meta_data" class="form-control" value="{{ $device->meta_data }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
