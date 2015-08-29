<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Response;
use App\Plant;
use App\User;
use App\Http\Requests\EditRequest;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;
use Auth;
use Lang;
use Datatables;

class UserController extends Controller {
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
        //parent::__construct();
        //$this->news = $news;
        //$this->user = $user;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {

        $plants = Plant::where('user_id', Auth::user()->id)->get();

        return view('users.home', compact('plants'));

        //return view('pages.welcome');
    }

    public function show($id) {
        $term = Auth::user()->id;

        $query = 'SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN 50hertz b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id . '" AND a.user_id = "' . $term . '"   
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  b.bundesland, NULL AS anschrift,  b.anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN bntza b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id . '" AND a.user_id = "' . $term . '"
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, b.anlagenhersteller 
                    FROM energy_map a JOIN amprion b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id . '" AND a.user_id = "' . $term . '"    
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber, NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN transnet_bw b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id . '" AND a.user_id = "' . $term . '"  
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN tennet b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id . '" AND a.user_id = "' . $term . '"';

        $plants = DB::select(DB::raw($query));
        return view('users.plant', compact('plants'));
    }

    public function getData() {
        $term = Auth::user()->id;
        $query = 'SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN 50hertz b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.user_id = "' . $term . '"   
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  b.bundesland, NULL AS anschrift,  b.anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN bntza b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.user_id = "' . $term . '"
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, b.anlagenhersteller 
                    FROM energy_map a JOIN amprion b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.user_id = "' . $term . '"    
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber, NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN transnet_bw b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.user_id = "' . $term . '"  
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN tennet b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.user_id = "' . $term . '"';

        $plants = DB::select(DB::raw($query));
        $results = [];

        foreach ($plants as $plant) {
            $results[] = ['id' => $plant->id, 'year' => $plant->Inbetriebnahme, 'value' => $plant->PLZ, 'ort' => $plant->Ort, 'strasse' => $plant->Strasse
                , 'key' => $plant->Anlagenschluessel, 'type' => $plant->Anlagentyp, 'leistung' => $plant->leistung,
                'energietraeger' => $plant->energietraeger, 'netzbetreiber' => $plant->netzbetreiber];
        }
        if (!empty($results)) {
            return Response::json($results, 200);
        } else {
            return Response::json('error', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit() {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit(EditRequest $request, $id) {
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->street = $request->street;
        $user->city = $request->city;

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }
        $user->save();

        return redirect('user/profile')->with('success', Lang::get('admin/users.create_new.edit'));
    }
    
    public function deletePlant($id) { 
        
        $plant = Plant::find($id);
        $plant->user_id = '';
        $plant->save();
        
        return redirect('user/home')->with('success', Lang::get('admin/users.create_new.plant'));
        
    }

}
