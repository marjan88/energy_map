<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Response;
use App\Plant;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\AnlagenregisterRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class AnlagenregisterController extends Controller {
    /*
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
        // Show the page
        $plants = Plant::where('user_id', Auth::user()->id)->get();
        return view('users.search', compact('plants'));
    }

    public function autocomplete() {


        $term = Input::get('term');

        $plants = Plant::where('PLZ', 'LIKE', $term . '%')->groupBy('PLZ')->get();

        $results = [];

        foreach ($plants as $plant) {
            $results[] = [ 'id' => $plant->id, 'year' => $plant->Inbetriebnahme, 'value' => $plant->PLZ, 'ort' => $plant->Ort, 'strasse' => $plant->Strasse
                ,  'type' => $plant->Anlagentyp];
        }
        if (!empty($results)) {
            return Response::json($results, 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function getResults() {$rules = array(
            'id' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(array(
                        'fail' => true,
                        'errors' => $validator->getMessageBag()->toArray()
            ));
        }


        $term = Input::get('id');
         $query = 'SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN 50hertz b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.PLZ = "' . $term . '"   
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  b.bundesland, NULL AS anschrift,  b.Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN bntza b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.PLZ = "' . $term . '"
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, b.anlagenhersteller 
                    FROM energy_map a JOIN amprion b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.PLZ = "' . $term . '"    
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber, NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN transnet_bw b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.PLZ = "' . $term . '"  
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN tennet b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.PLZ = "' . $term . '"';


        $plants = DB::select(DB::raw($query));

        $results = [];

        foreach ($plants as $plant) {
            $results[] = ['id' => $plant->id, 'year' => $plant->Inbetriebnahme, 'value' => $plant->PLZ, 'ort' => $plant->Ort, 'strasse' => $plant->Strasse
                , 'key' => $plant->Anlagenschluessel, 'type' => $plant->Anlagentyp, 'leistung' => $plant->leistung,
                'energietraeger' => $plant->energietraeger, 'netzbetreiber' => $plant->netzbetreiber,  'DSO' => $plant->DSO,
                'TSO' => $plant->TSO, 'kWh_2013' => $plant->kWh_2013, 'kWh_average' => $plant->kWh_average, 'bundesland' => $plant->bundesland,
                'anschrift' => $plant->anschrift, 'anlagennummer' => $plant->Anlagennummer, 'anlagenhersteller' => $plant->anlagenhersteller ];
        }
        if (!empty($results)) {
            return Response::json($results, 200);
        } else {
            return Response::json('error', 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {

        return view('users.select');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate() {
        $ids = Input::get('arrayId');
        $ids = explode(',', $ids);
       
        if (count($ids) > 25) {
            return redirect('user/anlagenregister')->with('error', 'To many plants for this client. Only 25 per client is aloud.');
        }
        return redirect('user/anlagenregister/confirm')->with('ids', $ids);
    }

    public function store() {
        $inputs = Input::all();
        $dbUserID = count(Plant::where('user_id', Auth::user()->id)->get());
        $inputID = count($inputs['id']);
        $res = $inputID + $dbUserID;

        if ($res > 25) {
            return redirect('user/anlagenregister')->with('error', 'To many plants for this client. Only 25 per client is aloud.');
        }
        foreach ($inputs['id'] as $key => $id) {

            $plant = Plant::find($id);
            if ($plant->user_id !== '') {
                return redirect('user/anlagenregister')->with('error', 'Another client has one or more selected plants');
            } else if ($plant->user_id == Auth::user()->id) {
                return redirect('user/anlagenregister')->with('error', 'User allready has one or more selected plants');
            } else {
                $plant->user_id = Auth::user()->id;
                $plant->save();
            }
        }
        return redirect('user/home')->with('success', 'Successfuly added data to user');
    }

    public function showData($id) {
        $term = \App\Plant::find($id)->Anlagenschluessel;

        $query = 'SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN 50hertz b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.Anlagenschluessel = "' . $term . '"   
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  b.bundesland, NULL AS anschrift,  b.anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN bntza b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.Anlagenschluessel = "' . $term . '"
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, b.anlagenhersteller 
                    FROM energy_map a JOIN amprion b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.Anlagenschluessel = "' . $term . '"    
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber, NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN transnet_bw b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.Anlagenschluessel = "' . $term . '"  
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN tennet b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.Anlagenschluessel = "' . $term . '"';
        $plants = DB::select(DB::raw($query));
        return view('users.show', compact('plants'));
    }

}
