<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Blog extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)
            ->select([
                'id',
                'first_name',
                'last_name',
            ]);
    }
}
