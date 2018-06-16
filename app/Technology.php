<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $table = 'technologies';
    /**
     * Defines if timestamps updated_at and created_at have to be processed.
     *
     * @var bool
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function technologies()
    {
        return $this->belongsToMany('App\User', 'technology_user', 'technology_id', 'user_id');
    }
}
