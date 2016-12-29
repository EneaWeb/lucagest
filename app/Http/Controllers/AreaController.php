<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Area as Area;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::where('active', '1')->orderBy('name')->get();
        return view('pages.areas', compact('areas'));
    }

    public function saveArea(Request $request)
    {
        $area_name = $request->get('area_name');
        $area = new Area([
            'name' => $area_name,
            'active' => 1
        ]);
        $area->save();

        return redirect()->back();
    }

    public function deleteArea(Request $request)
    {
        $id = $request->get('area_id');
        $area = Area::find($id);
        // check if there are orders linked with this area
        $ordersWithArea = \App\OrderDetail::where('area_id', $id)->get();
        // if everything is ok
        if ($area != NULL && $ordersWithArea->isEmpty()) {
            // delete area
            $area->delete();
        } else {
            // deactivate area
            $area->active = 0;
            $area->save();
        }
        $services = \App\Service::where('area_id', $id)->delete();

        return redirect()->back();
    }

    public function modal_edit(Request $request)
    {
        $area = Area::find($request->get('area_id'));
        return view('modals.edit_area', compact('area'));
    }

    public function editArea(Request $request)
    {
        $area = Area::find($request->get('area_id'));
        $area->name = $request->get('name');
        $area->save();

        return redirect()->back();
    }

}