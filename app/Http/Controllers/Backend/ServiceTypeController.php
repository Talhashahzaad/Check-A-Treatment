<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceType;
use Illuminate\Contracts\Validation\Validator;

class ServiceTypeController extends Controller
{
    //

    public function AllType()
    {

        $types = ServiceType::latest()->get();
        return view('admin.backend.type.all_type', compact('types'));
    } //end method AllType

    public function AddType()
    {
        return view('admin.backend.type.add_type');
    } //end method AddType


    public function StoreType(Request $request)
    {

        $request->validate([
            'type_name' => 'required|unique:service_types|max:200',
            'type_icon' => 'required',
            'type_parent' => 'required',
            'type_description' => 'required'
        ]);
        ServiceType::insert([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
            'type_parent' => $request->type_parent,
            'type_description' => $request->type_description
        ]);

        $notification = array(
            'message' => 'Service Type Created successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.type')->with($notification);
    }
}
