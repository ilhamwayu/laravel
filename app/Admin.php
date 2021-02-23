<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $fillable = [ 'nama','jk', 'tmp_lahir','tgl_lahir','no_hp', 'email', 'alamat', 'idakun'];
}
