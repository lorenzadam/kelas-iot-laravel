<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('device.index', [
            "devices" => $devices,
        ]);
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {
        $device = [
            "serial_number" => $request->input('serial_number'),
            "meta_data" => $request->input('meta_data'),
        ];

        // dd($device);
        Device::create($device);

        return redirect('/devices');
    }

    public function edit($id)
    {
        $device = Device::find($id);
        return view('device.edit', [
            "device" => $device,
        ]);
    }

    public function update(Request $request, $id)
    {
        $device = [
            "serial_number" => $request->input('serial_number'),
            "meta_data" => $request->input('meta_data'),
        ];

        Device::find($id)->update($device);

        return redirect('/devices');
    }

    public function delete($id)
    {
        Device::find($id)->delete();

        return redirect('/devices');
    }
}
