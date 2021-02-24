<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Main extends Model
{
    public function to_field($table, $field, $key)
    {

        $q = "SELECT " . $field . " FROM " . $table . " " . $key;

        $x = DB::query($q)->get();

        return $x->toArray();
    }

}
