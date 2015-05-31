<?php

namespace App\Http\Controllers;
use Response;
use App\Plant;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;
use Auth;

use Datatables;

class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

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
       

        return view('pages.home');

        //return view('pages.welcome');
    }
    public function show($id) {
        $term = Auth::user()->id;        
        
        $query = 'SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN 50hertz b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id .'" AND a.user_id = "' . $term . '"   
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber,  b.bundesland, NULL AS anschrift,  b.anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN bntza b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id .'" AND a.user_id = "' . $term . '"
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, b.anlagenhersteller 
                    FROM energy_map a JOIN amprion b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id .'" AND a.user_id = "' . $term . '"    
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, b.netzbetreiber, NULL AS bundesland, NULL AS anschrift,  NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN transnet_bw b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id .'" AND a.user_id = "' . $term . '"  
                        
                    UNION ALL
                    SELECT a.id, a.PLZ, a.DSO, a.TSO, a.Ort, a.kWh_2013, a.kWh_average, a.Inbetriebnahme, a.Anlagenschluessel, a.Anlagentyp, a.Strasse, 
                    b.energietraeger, b.leistung, NULL AS netzbetreiber, b.bundesland, b.anschrift, NULL AS Anlagennummer, NULL AS anlagenhersteller
                    FROM energy_map a JOIN tennet b ON a.Anlagenschluessel = b.anlagenschluessel WHERE a.id = "' . $id .'" AND a.user_id = "' . $term . '"';
        
        $plants = DB::select(DB::raw($query));
        return view('pages.plant', compact('plants'));
        
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

}
