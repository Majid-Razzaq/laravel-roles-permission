<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // This method will show permissions page
    public function index(){
        $permissions = Permission::orderBy('created_at','DESC')->paginate(10);
        return view('permissions.list',[
            'permissions' => $permissions,
        ]);
    }

    // This method will show permissions create page
    public function create(){
        return view('permissions.create');
    }

    // This method will insert a permissions in DB
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3'
        ]);
        if($validator->passes()){
            Permission::create(['name' => $request->name ]);
            return redirect()->route('permissions.index')->with('success','Permission added successfully.');
        }else{
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    // This method will show edit permissions
    public function edit($id){
        $permission = Permission::findOrFail($id);
        return view('permissions.edit',[
            'permission' => $permission,
        ]);
    }

    // This method will update permissions in DB
    public function update(Request $request, $id){

        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
        ]);
        if($validator->fails()){
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }
        
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success','Permission updated successfully.');

    }

    // This method will delete permissions in DB
    public function destroy(Request $request){

        $id = $request->id;

        $permission = Permission::find($id);
        if($permission == null){
            Session()->flash('error','Permission not found');
            return response()->json([
                'status' => false,
            ]);
        }
        $permission->delete();
        Session()->flash('success','Permission deleted successfully.');
        return response()->json([
                'status' => true,
            ]);    }
}
