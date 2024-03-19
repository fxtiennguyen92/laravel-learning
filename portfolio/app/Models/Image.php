<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = ['category', 'src'];

    // Phương thức để lấy dự án mà hình ảnh thuộc về
    public function project()
    {
        // 'parent_id' là khóa ngoại trong bảng 'images' tham chiếu đến bảng 'projects'
        return $this->belongsTo(Project::class, 'parent_id');
    }
    public function banner()
    {
        return $this->belongsTo(Project::class, 'parent_id');
    }
}
