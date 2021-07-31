<?php
namespace App\Model\Panel;
use http\Url;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model ;
use Illuminate\Auth\Authenticatable as Authenticabletrait;
use Illuminate\Contracts\Auth\Authenticatable;

class Recipes extends Model implements Authenticatable
{

    use Authenticabletrait;
    use Notifiable;
    protected $collection = 'recipes';
    protected $primarykey = "_id";
    protected $appends=['img_url'];
    protected $guarded = [];
    public function recipes()
    {
        return $this->hasOne(recipes_file::class, 'recipes_id', "_id")->select("img_url","recipes_id")->where(["isCover"=>1]);
    }

    public function getImgUrlAttribute()
    {
        return "https://api.klinikdiyetisyen.com/public".Storage::url($this->recipes->img_url);
        return url($this->recipes->img_url);
    }
}
