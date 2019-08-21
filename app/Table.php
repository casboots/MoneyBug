<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    //protected $primaryKey = 'table_id';

    // public function user(){
    //     return $this->belongsTo('App\User');
    // }
}
