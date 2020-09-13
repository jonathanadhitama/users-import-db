<?php
require "vendor/autoload.php";
use Illuminate\Database\Eloquent\Model;

/**
 * Class User Model
 */
class User extends Model
{
    /**
     * Table name associated with the model
     * @var string
     */
    protected $table = 'users';

    /**
     * Because we are using email as the primary key, which is a non-numeric string.
     * We have to set the incrementing attribute as false
     * @var bool
     */
    public $incrementing = false;

    /**
     * Type of the primary key
     * @var string
     */
    protected $keyType = 'string';

    /**
     * User model does not need to be timestamped
     * @var bool
     */
    public $timestamps = false;

    /**
     * Allow mass assignment of all User Model attributes (name, surname, and email)
     * @var array
     */
    protected $guarded = [];
}