<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'linkgitHub'];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    // Phương thức để lấy liên kết 
    public function image()
    {
        // 'parent_id' là khóa ngoại trong bảng 'images' tham chiếu đến bảng 'projects'
        return $this->hasOne(Image::class, 'parent_id');
    }

    public static function getAll() {
        return Project::with('skills')->get();
    }
}
