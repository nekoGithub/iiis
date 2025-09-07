<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function registrar(Request $request)
    {
        $device = Device::updateOrCreate(
            ['nombre' => $request->nombre],
            ['ip' => $request->ip]
        );

        return response()->json(['success' => true, 'device' => $device]);
    }

    public function disposititvo($nombre)
    {
        $device = Device::where('nombre', $nombre)->first();
        return response()->json($device);
    }
}
