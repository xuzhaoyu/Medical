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
    protected $fillable = array('PSize', 'PCount','PBarcode','MName',
        'HBarcode','expire','HName','HUser','SId','SUser','status',
        'OrderDate','SendDate','ReceivedDate','orderNum', 'PName', 'PBarSecondary', 'actual', 'selected');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
