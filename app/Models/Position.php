<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_name',
        'position_code'
    ]; 

    protected static function newPosition($input)
    {
        try {
            Position::create($input);
        } catch (Exception $ex) {
            return false;
        }
    }

    protected static function upd($input, $id)
    {
        try {
            Position::where('id', $id)
            ->update($input);
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function dlt($id)
    {
        try {
            Position::where('id', $id)->delete();
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
