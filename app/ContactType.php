<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    protected $table = 'contact_types';
    public $timestamps = false;

    //двойной ключ из-за того, что
    protected $fillable = [
        'contact_type'
    ];

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
}
