<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  GroupBanUsers extends Model
{
    use SoftDeletes;

    protected $table = 'group_ban_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'group_id',
    ];

    public function group()
    {
        return $this->hasOne('App\Models\Group',"id","group_id");
    }
}
