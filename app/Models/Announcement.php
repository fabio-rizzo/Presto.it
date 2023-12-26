<?php

namespace App\Models;

use App\Models\Image;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['title', 'description','price', 'image', 'is_accepted', 'category_id'];

    //funzione per la ricerca degli articoli
    public function toSearchableArray()
    {
        $category = $this->category;
        $array =  [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $category
        ];
        return $array;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function setAccepted($value){ //setta l'annuncio come revisionato
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public static function toBeRevisionedCount(){  //conta tutti gli annunci che hanno null che quindi sono da revisionare
        return Announcement::where('is_accepted', null)->count();
    }
    
    /* può essere chiamato come $announcement->formatted_price Laravel si arrangia a trovare questa func */
    public function getFormattedPriceAttribute() 
    {
        // cambia il . per una ,
        $prezzo = floatval($this->attributes['price']);
        $prezzoFormatato = number_format($prezzo, 2, ',', '.');

        // divide numeri interi e decimali
        $parti = explode(',' , $prezzoFormatato);
        return ['interi' => $parti[0], 'decimali' => $parti[1]]; 
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
}
