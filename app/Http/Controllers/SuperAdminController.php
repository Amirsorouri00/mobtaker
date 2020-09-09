<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Teacher;
use App\School;
use App\Models\User;
use Illuminate\Http\Request;


class SuperAdminController extends Controller
{   
	public function __construct()
	{
		$this->middleware('auth:api');
    }
    
    public function add_school(Request $request)
	{
        if ($request->user()->hasRole('SuperAdmin')) {
            $school = School::create($request->all());
            $user = User::role('Admin')->first();

            $school->manager()->associate($user);
            return response(['data' => $school], 201);
        }
    }

    public function list(Request $request)
	{
        if ($request->user()->hasRole('SuperAdmin')) {
            $lists = School::with('classes.teacher.students');

            return response(['data' => $lists], 201);
        }
    }


    /**
     * return the list of stores and their panel's products to the client.
     *
     * @return dashboard-data
     */
    public function teacher_students($request)
    {
        $user = $request->user()->id;
        if ($request->user()->hasRole('SuperAdmin')) {
            $lat = $request->user()->lat;
            $lang = $request->user()->lat;
            $nearByStores = find_nearby_stores($lat, $long);

            $storesRes = DB::table('stores')->whereIn('id', $nearByStores);
        
            return response(['data' => $storesRes], 200);
        }
    }


    /** 
     * calculates "the closest 20 locations that are within a 
     * radius of 25 miles to the 37, -122 coordinate."
     * 
     * @param lat,long
    */
    private function find_nearby_stores ($lat, $long) 
    {
        $nearByStores = DB::table('stores')->where('status', 'open')
                    ->select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(37) ) * cos( radians( '.$lat.' ) ) \
                        * cos( radians( '.$lang.') - radians(-122) ) + sin( radians(37) ) * sin(radians('.$lat.')) ) ) AS distance \
                        HAVING distance < 25 \
                        ORDER BY distance ') );
        return $nearByStores;
    }
}