<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use Lang;
use Input;
use Response;
use App\AssignedRoles;
use App\Role;
use App\Plant;
use App\Key;
use Mail;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\KeyRequest;
use Datatables;

class UserController extends AdminController {
    /*
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
        // Show the page
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {

//        $roles = Role::all();              
//        $permisionsadd =array();
//        // Selected groups
//        $selectedRoles = array();

        return view('admin.users.create_edit');
    }

    public function autocomplete() {


        $term = Input::get('term');

        $plants = Plant::distinct()->select('PLZ')->where('PLZ', 'LIKE', $term . '%')->get();

        $results = [];

        foreach ($plants as $plant) {
            $results[] = [ 'id' => $plant->id, 'year' => $plant->Inbetriebnahme, 'value' => $plant->PLZ, 'ort' => $plant->Ort, 'strasse' => $plant->Strasse
                , 'key' => $plant->Anlagenschluessel, 'type' => $plant->Anlagentyp];
        }
        if (!empty($results)) {
            return Response::json($results, 200);
        } else {
            return Response::json('error', 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(UserRequest $request) {

        $user = new User ();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->street = $request->street;
        $user->city = $request->city;
        $user->username = md5(microtime() . env('APP_KEY'));
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->confirmed = $request->confirmed;
        $user->save();

        $role = new AssignedRoles();
        $role->role_id = 2;
        $role->user_id = $user->id;
        $role->save();

        return redirect('admin/users')->with('success', Lang::get('admin/users.create_new.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($id) {
        $plants = Plant::where('user_id', $id)->get();
        $user = User::find($id);
        $roles = Role::all();
        $selectedRoles = AssignedRoles::where('user_id', '=', $user->id)->lists('role_id');

        return view('admin.users.create_edit', compact('user', 'roles', 'selectedRoles', 'plants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit(UserEditRequest $request, $id) {

        $user = User::find($id);
       
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->street = $request->street;
        $user->city = $request->city;
        $user->username = md5(microtime() . env('APP_KEY'));
        $user->confirmed = $request->confirmed;

        $password = $request->password;
        $passwordConfirmation = $request->password;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }
        $user->save();
        AssignedRoles::where('user_id', '=', $user->id)->delete();

        $role = new AssignedRoles;
        $role->role_id = 2;
        $role->user_id = $user->id;
        $role->save();
        return redirect('admin/users')->with('success', Lang::get('admin/users.create_new.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function getDelete($id) {
        $user = User::find($id);
        // Show the page
        return view('admin.users.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete($id) {
        $plants = Plant::where('user_id', $id)->get();
        foreach ($plants as $plant) {
            $plant->user_id = '';
            $plant->save();
        }
        $user = User::find($id);
        $user->delete();
        return back()->with('success', Lang::get('admin/users.create_new.delete'));
    }

    public function destroy() {

        $inputs = Input::all();

        foreach ($inputs['id'] as $id) {
            $plant = Plant::find($id);
            $plant->user_id = '';
            $plant->save();
        }
        return back()->with('success', Lang::get('admin/users.create_new.plant'));
    }

    public function getCode() {
       
        $key = Key::all();
        
        if(count($key)>0) {
             $key = Key::first();
            return view('admin.users.code', compact('key'));
        }
        
        return view('admin.users.code');
    }

    public function postCode(KeyRequest $request) {
        $keyOld = Key::first();
        if (count($keyOld) > 0) {
            $keyOld->key = $request->code;
            $keyOld->save();
        } else {
            $key = new Key();
            $key->key = $request->code;
            $key->save();
        }
        return back()->with('success', Lang::get('admin/users.create_new.key'));
    }

    public function postMail() {
        $email = Input::get('email');
        $subject = Input::get('subject');
        $message = Input::get('message');
        $code = Input::get('code');

        // send mail
        Mail::send('emails.register', ['code' => $code], function($message) use ($email, $subject) {
            $message->to($email, 'Energien Plant')->subject($subject. ' for the site Energien Plant');
        });

        return back()->with('success', Lang::get('admin/modal.mail.success'));
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data() {
        $users = User::select(array('users.id', 'users.name', 'users.last_name', 'users.city', 'users.email', 'users.confirmed'))->orderBy('users.email', 'ASC');
        //$users = User::select(array('users.id','users.name','users.email', 'users.created_at'))->orderBy('users.email', 'ASC');

        return Datatables::of($users)
                        ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
                        ->add_column('actions', '@if($id == "1")<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span>  {{ Lang::get("admin/modal.edit") }}</a>
                            @else
                            <a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span>  {{ Lang::get("admin/modal.edit") }}</a>
                            <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" onclick="return confirm(\'Are you sure you want to delete this user?\');" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> {{ Lang::get("admin/modal.delete") }}</a>
                            @endif
                ')
                        ->remove_column('id')
                        ->make();
    }

}
