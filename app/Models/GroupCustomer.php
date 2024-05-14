<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCustomer extends Model
{
    use HasFactory;

    protected $fillalbe = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class,'group_customer_id','id');
    }
}
