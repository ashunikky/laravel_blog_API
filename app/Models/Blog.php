<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RyanChandler\Comments\Concerns\HasComments;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category',
        'title',
        'content',
        'tags',
        'user_id'
    ];
    use HasFactory;
    use HasComments;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
