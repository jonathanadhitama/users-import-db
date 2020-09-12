<?php
require "vendor/autoload.php";
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];
}