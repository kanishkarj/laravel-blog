<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{

    public function __construct(){
        //$this->middleware('auth', ['except' => ['index']]);
    }

    // protected $fillable = []; // allows only the items in the array
     protected $guarded = []; // disallows only the items in the array

     public function comments(){
        return $this->hasMany(Comments::class);
     }

    public function user(){
        return $this->belongsTo(User::class);
    }

     public function addComment($body){
         Comments::create([
             'body' => $body,
             'post_id'=> $this->id
         ]);
     }

     public static function archives(){
         return static::selectRaw('year(created_at) as year, monthname(created_at) as month,count(*) published')
        -> groupBy('year','month') -> orderByRaw('min(created_at) desc')
        -> get() -> toArray();
     }

     public function scopeFilter($query,$filters){
        
        if($month = $filters['month']){
            $query -> whereMonth('created_at', Carbon::parse($month)->month);
        }
        if($year = $filters['year']){
            $query -> whereYear('created_at', $year);
        }
     }

    public function Tag(){
        return $this->BelongsToMany(Tag::class);
    }

}
