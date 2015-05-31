<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
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

class AnlagenregisterController extends AdminController {
    /*
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
        // Show the page

        return view('admin.plants.index');
    }

    public function autocomplete() {


        $term = Input::get('term');

        $plants = Plant::where('PLZ', 'LIKE', $term . '%')->groupBy('PLZ')->get();

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

    public function getResults() {

        $rules = array(
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

        return view('admin.plants.select');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate() {
        $ids = Input::get('id');
        
        if (count($ids) > 25) {
            return redirect('admin/anlagenregister')->with('error', 'To many plants for this client. Only 25 per client is aloud.');
        }
        return redirect('admin/anlagenregister/select-user')->with('ids', $ids);
    }

    public function store() {
        $inputs = Input::all();
        $dbUserID = count(Plant::where('user_id', $inputs['user_id'])->get());
        $inputID = count($inputs['id']);
        $res = $inputID + $dbUserID;

        if ($res > 25) {
            return redirect('admin/anlagenregister')->with('error', 'To many plants for this client. Only 25 per client is aloud.');
        }
        foreach ($inputs['id'] as $key => $id) {

            $plant = Plant::find($id);
            if ($plant->user_id == $inputs['user_id']) {
                return redirect('admin/anlagenregister')->with('error', 'User allready has one or more selected plants');
            } else {
                $plant->user_id = $inputs['user_id'];
                $plant->save();
            }
        }
        return redirect('admin/anlagenregister')->with('success', 'Successfuly added data to user');
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
        return view('admin.plants.show', compact('plants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id) {
        $news = Article::find($id);
        $languages = Language::all();
        $language = $news->language_id;
        $newscategories = ArticleCategory::all();
        $newscategory = $news->newscategory_id;

        return view('admin.news.create_edit', compact('news', 'languages', 'language', 'newscategories', 'newscategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(NewsRequest $request, $id) {
        $news = Article::find($id);
        $news->user_id = Auth::id();
        $news->language_id = $request->language_id;
        $news->title = $request->title;
        $news->article_category_id = $request->newscategory_id;
        $news->introduction = $request->introduction;
        $news->content = $request->content;
        $news->source = $request->source;

        $picture = "";
        if (Input::hasFile('picture')) {
            $file = Input::file('picture');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
        }
        $news->picture = $picture;
        $news->save();

        if (Input::hasFile('picture')) {
            $destinationPath = public_path() . '/images/news/' . $news->id . '/';
            Input::file('picture')->move($destinationPath, $picture);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function getDelete($id) {
        $news = Article::find($id);
        // Show the page
        return view('admin.news.delete', compact('news'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request, $id) {
        $news = Article::find($id);
        $news->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data() {
        $news = Article::join('languages', 'languages.id', '=', 'articles.language_id')
                ->join('article_categories', 'article_categories.id', '=', 'articles.article_category_id')
                ->select(array('articles.id', 'articles.title', 'article_categories.title as category', 'languages.name', 'articles.created_at'))
                ->orderBy('articles.position', 'ASC');

        return Datatables::of($news)
                        ->add_column('actions', '<a href="{{{ URL::to(\'admin/news/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ Lang::get("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/news/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ Lang::get("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">')
                        ->remove_column('id')
                        ->make();
    }

    /**
     * Reorder items
     *
     * @param items list
     * @return items from @param
     */
    public function getReorder(ReorderRequest $request) {
        $list = $request->list;
        $items = explode(",", $list);
        $order = 1;
        foreach ($items as $value) {
            if ($value != '') {
                Article::where('id', '=', $value)->update(array('position' => $order));
                $order++;
            }
        }
        return $list;
    }

}
