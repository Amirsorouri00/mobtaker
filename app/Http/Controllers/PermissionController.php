<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{   
	public function __construct()
	{
		// $this->middleware('auth:api');
	}

	public function store(Request $request)
	{
		if ($request->user()->can('create-tasks')) {
			//Code goes here
		}
	}

	public function destroy(Request $request, $id)
	{   
		if ($request->user()->can('delete-tasks')) {
			//Code goes here
		}

	}

	/**
	 * A CRUD Service to add Role and Permissions
	 * 
	 * @param
	 * @return
	 */
    public function permission()
    {   
    	$superAdmin = Role::create(['name' => 'SuperAdmin']);
    	$admin = Role::create(['name' => 'Admin']);
		$permission1 = Permission::create(['name' => 'see admins']);
		$permission2 = Permission::create(['name' => 'see teachers']);
		$permission3 = Permission::create(['name' => 'see students']);

		$superAdmin->givePermissionTo($permission1);
		$superAdmin->givePermissionTo($permission2);
		$superAdmin->givePermissionTo($permission3);


		$admin->givePermissionTo($permission2);
		$admin->givePermissionTo($permission3);

		return response(['data' => "successfull" ], 201);
    }
}