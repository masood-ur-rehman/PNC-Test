<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $table = 'companies';
    protected $fillable = ['name', 'email','logo','website'];


    public function employees()
    {
        return $this->hasMany('App\Models\Employees', 'company_id');
    }
}
