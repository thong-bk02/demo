<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'event_content',
        'start_date',
        'end_date',
        'status'
    ];

    protected static function getAllEvent(){
        $event = DB::table('events')
        ->orderByDesc('start_date')->paginate(10);
        return $event;
    }

    protected static function createEvent($input){
        Event::create($input);
    }

    protected static function updateEvent($input, $id){
        Event::where('id', $id)->update($input);
    }
}
