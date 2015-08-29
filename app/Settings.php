<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    protected $table = 'settings';
    
    protected $fillable = ['entity_name', 'name', 'type'];
    
    public static function getImage($entity, $name) {
       $image = Settings::where('entity_name', $entity)->where('name', $name)->first();
       if($image) {
           return $background = '/assets/site/css/images/' . $image->name . '.' . $image->type;
       }
       return null;
    }

}
