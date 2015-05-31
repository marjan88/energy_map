<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Plant extends Model {

	protected $table = 'energy_map';
        public $timestamps = false;
        
        public function user() {
            return $this->belongsTo('App\User');
        }
        
        public function assignUser($user)
	{
		$this->user()->attach($user);
	}

	public function removeUser($user)
	{
		$this->user()->dissociate($user);
	}
        

}
