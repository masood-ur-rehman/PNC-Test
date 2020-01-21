<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = ['company_id','first_name','last_name', 'email','phone'];

    public function Company()
    {
        return $this->belongsTo('App\Models\Companies', 'company_id');
    }
}
