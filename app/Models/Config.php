<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Config extends Model
{
    public $timestamps = false;

    protected $guarded = [];


    public function setToggleSidebarAttribute($value) {
        $this->attributes['toggle_sidebar'] = !$this->attributes['toggle_sidebar'];
    }


    public function setLogoAttribute(?UploadedFile $file) {
        if($file) {
            if(Storage::exists($this->logo)) {
                Storage::delete($this->logo);
            }
            $name = Storage::putFile('img', $file, 'public');
            $this->attributes['logo'] = $name;
        }
    }
}
