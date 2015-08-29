<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Response;
use App\Plant;
use App\User;
use PDF;
use App\Http\Requests\EditRequest;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;
use Auth;
use Lang;
use Datatables;

class DocumentController extends Controller {

    
    public function createPdf($id) {
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
        
        
        $pdf = \PDF::loadView('users.pdf.plant_info', array('plants' => $plants));
        return $pdf->stream();
       
    }

}
