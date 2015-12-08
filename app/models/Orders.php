<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Orders extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    public $timestamps = false;
    protected $fillable = array('PName', 'PBarcode','HBarcode','expire','PCount','HId', 'HUser', 'SId', 'SUser', 'status', 'OrderDate', 'SendDate', 'ReceivedDate');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
