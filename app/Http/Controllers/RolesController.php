<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use App\Models\Review;
use App\Models\Product;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Roles::all();
    }

    public function manageRoles()
    {
        $roles = Roles::all();
        $isAdmin = Controller::isAdmin();
        return view('manage-roles', compact('roles', 'isAdmin'));
    }

    public function getRole($id)
    {
        $role = Role::where('id', $id)->first();
        $isAdmin = Controller::isAdmin();
        return view('edit-role', compact('role', 'isAdmin'));
    }

    public function deleteRole($id)
    {
        Role::destroy($id);
        if(Category::find($id)>0)
            return redirect()->back()->with('error', 'Role could not be deleted');
        return redirect()->back()->with('message', 'Role has been deleted successfully');
    }


    public function addRole(Request $request){
        $title = $request->new_role_name;
        $description = $request->new_role_description;
        if(isset($title) && trim($title) != ""){
            $title_found = Role::where('name',$title)->first();
            if (empty($title_found->id)){
                $save = new Role();
                $save->id=Str::uuid();
                $save->name=$title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }
                $save->description=$description;
                $save->created_by=Auth::user()->getAuthIdentifierName();
                $save->save();

                return redirect()->route('role.manage')->with('message', 'Role has been successfully added');
            }else{
                return redirect()->route('role.manage')->with('Error', 'Role name is already available');
            }

        }
        return redirect()->route('role.manage')->with('Error', 'Role name cannot be empty');
    }

    public function editRoleForm($id){
        $role = Role::where('id', $id)->first();
        if (empty($role)){
            return redirect()->back()->with('Error', 'Role does not exist');
        }
        $isAdmin = $this->isAdmin();
        return view('roles-form', compact('role', 'isAdmin'));
    }

    public function editRole(Request $request, $id){
        $title = $request->new_role_name;
        $description = $request->new_role_description;
        if(isset($title) && trim($title) != "" && trim($description) != "" ){
            $role = Category::where('id', $id)->first();
            if (!empty($role)){
                $role->name=$title;
                if(!isset($description) || trim($description) != ""){
                    $description = "All ".$title;
                }
                $role->description=$description;
                $role->save();

                return redirect()->route('role.manage')->with('message', 'Role has been successfully added');
            }else{
                return redirect()->back()->with('Error', 'Role name is already available');
            }

        }
        return redirect()->back()->with('Error', 'Role name cannot be empty');
    }
}
