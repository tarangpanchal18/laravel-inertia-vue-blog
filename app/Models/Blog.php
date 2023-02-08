<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'seo_keyword',
        'seo_description',
        'image',
        'view',
        'view_user_detail',
        'status',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'view' => 'integer',
    ];

    /**
     * Defines the replationship with User Table
     *
     * @return relationship
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Format the CreatedAt Date
     *
     * @return date
     */
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    /**
     * Format the UpdatedAt Date
     *
     * @return date
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    /**
     * Scope a query to Filter Blog Data
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterBlog($query)
    {
        $q = request()->get('q');
        if ($q) {
            return $query->where('blogs.title', 'like', '%'. $q .'%');
        }
    }

    /**
     * Defines the relationship with comment table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
