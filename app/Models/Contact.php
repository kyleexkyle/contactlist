<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'company',
        'phone',
        'email',
    ];

    /**
     * only take the tasks the belongs to
     * the authenticated user
     *
     * @param $query
     * @return mixed
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
