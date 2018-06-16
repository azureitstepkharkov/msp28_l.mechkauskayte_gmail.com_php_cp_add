<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table = 'contacts';
    public $timestamps = false;

    protected $fillable = [
        'type_id',
        'value'
    ];

    public function user()
    {
        return $this->hasOne('App\User'); // или контакт имеет одного юзера? hasOne
    }

    public function contact_type()
    {
        $this->hasOne('App\ContactType');
    }
}
