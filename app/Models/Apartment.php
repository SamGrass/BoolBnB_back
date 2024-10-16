<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    // definizione delle fillable

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'rooms',
        'beds',
        'bathrooms',
        'mq',
        'address',
        'city',
        'civic_number',
        'longitude',
        'latitude',
        'img',
        'is_visible',
    ];



    // relazione con sponsorships
    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class)
            ->withPivot('end_date');
    }

    // relazione con messages

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    // relazione con views

    public function views()

    {
        return $this->hasMany(View::class);
    }

    // relazione con  services

    public function services()
    {
        // collegamento con la tabella pivot apartment_service
        return $this->belongsToMany(Service::class, 'apartment_service')
            ->withTimestamps();
    }
}
