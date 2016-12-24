<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Service as Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('area_id')->orderBy('id', 'asc')->get();
        return view('pages.services', compact('services'));
    }

    public function saveService(Request $request)
    {
        $service_name = $request->get('service_name');
        $area_id = $request->get('area_id');
        $price = number_format($request->get('price'), 2, '.', '');
        $service = new Service([
            'name' => $service_name,
            'area_id' => $area_id,
            'price' => $price
        ]);
        $service->save();

        return redirect()->back();
    }

    public function deleteService(Request $request)
    {
        $id = $request->get('service_id');
        $service = Service::find($id);
        if ($service != NULL) {
            $service->delete();
        }

        return redirect()->back();
    }

    public function modal_edit(Request $request)
    {
        $service = Service::find($request->get('service_id'));
        return view('modals.edit_service', compact('service'));
    }

    public function editService(Request $request)
    {
        $service = Service::find($request->get('service_id'));
        $service->name = $request->get('name');
        $service->price = number_format($request->get('price'), 2, '.', '');
        $service->save();

        return redirect()->back();
    }

    public function getServiceSupplierPrice(Request $request)
    {
        $id = $request->serviceId;
        return \App\Service::find($id)->price;
    }

}