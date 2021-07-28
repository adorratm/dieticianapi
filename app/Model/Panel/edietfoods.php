<?php
namespace App\Model\Panel;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model ;
use Illuminate\Auth\Authenticatable as Authenticabletrait;
use Illuminate\Contracts\Auth\Authenticatable;

class edietfoods extends Model implements Authenticatable
{

    use Authenticabletrait;
    use Notifiable;
    protected $collection = 'edietfoods';
    protected $primarykey = "_id";
    protected $guarded = [];
    protected $appends=['ageGroupss'];
    public function edietfoods()
    {
        return $this->hasOne(edietfoods_file::class, 'edietfoods_id', "_id")->select("img_url","edietfoods_id")->where(["isCover"=>1]);
    }

    public function getAgeGroupssAttribute()
    {
        return intval(str_replace("+","",$this->attributes['ageGroups']));
    }

    public function scopeAgeFilter($query,$year)
    {
        if($year>18)
            return $query->where('ageGroups',"18+");
        if($year>10)
            return $query->where('ageGroups',"10+");
        if($year>1)
            return $query->where('ageGroups',"1+");
        if($year>0)
            return $query->where('ageGroups',"0+");
    }

//    public function meals()
//    {
//        return $this->hasMany();
//    }
}
