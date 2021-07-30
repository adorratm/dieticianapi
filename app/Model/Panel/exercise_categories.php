<?php
namespace App\Model\Panel;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model ;
use Illuminate\Auth\Authenticatable as Authenticabletrait;
use Illuminate\Contracts\Auth\Authenticatable;

class exercise_categories extends Model implements Authenticatable
{

    use Authenticabletrait;
    use Notifiable;
    protected $collection = 'exercise_categories';
    protected $primarykey = "_id";
    protected $guarded = [];
    protected $appends=['img_url'];
    public function exercise_categories()
    {
        return $this->hasOne(exercise_categories_file::class, 'exercise_category_id', "_id")->select("img_url","exercise_category_id")->where(["isCover"=>1]);
    }

    public function getImgUrlAttribute()
    {
        return url($this->exercise_categories->img_url);
    }

    public function exercises()
    {
        return $this->hasMany(\App\Model\Theme\Exercises::class,'category_id');
    }
}
