<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Mail;
use Input;
use Lang;
use App\Key;
use App\Settings;
use App\Http\Requests\Admin\KeyRequest;

class SettingsController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $key = Key::all();
        $image =  Settings::getImage(get_class(new Settings), 'background');
        if (count($key) > 0) {
            $key = Key::first();
            return view('admin.settings.index', compact('key', 'image'));
        }
        return view('admin.settings.index', compact('image'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(KeyRequest $request) {

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
            $message->to($email, 'Energien Plant')->subject($subject . ' for the site Energien Plant');
        });

        return back()->with('success', Lang::get('admin/modal.mail.success'));
    }

    public function storeImage() {

        if (Input::hasFile('image')):
            $file = Input::file('image');
            //check if exsits
            $background = Settings::getImage(get_class(new Settings), 'background');

            if ($background) {
                
                if (file_exists($background)) {
                    unlink($background);
                }
            }

            $image = new Settings();
            $image->entity_name = get_class($image);
            $image->name = 'background';
            $image->type = $file->getClientOriginalExtension();
            $image->save();

            
            $imgPth = public_path() . '/assets/site/css/images/';
            $imgName = 'background.' . $file->getClientOriginalExtension();
            $file->move($imgPth, $imgName);

            return back()->with('success', Lang::get('admin/settings.crud.create_image'));
        endif;
    }

}
