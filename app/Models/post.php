<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
class post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected static function booted()
    {
        static::addGlobalScope('activeUser', function (Builder $builder) {
            // Միշտ ստուգել, որ պոստի տերը արգելափակված չլինի
            $builder->whereHas('user', function ($query) {
                $query->where('is_blocked', false);
            });
        });
    }
    protected $guarded  = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
