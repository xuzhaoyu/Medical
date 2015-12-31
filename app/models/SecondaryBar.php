<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class SecondaryBar extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'secondary_barcode';
    public $timestamps = false;
    protected $fillable = array('orderNum', 'PBarcode', 'PBarSecondary');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
