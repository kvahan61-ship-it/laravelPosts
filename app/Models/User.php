<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phoneNumber',
        'gender',
        'avatar',
        'role',
        'is_blocked',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function savedPosts()
    {
        // 'saved_posts' — это имя твоей промежуточной таблицы в базе данных
        return $this->belongsToMany(Post::class, 'saved_posts');
    }
    public function likePosts(){
        return $this->belongsToMany(Post::class, 'posts_likes');
    }
}
