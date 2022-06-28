<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr;

class Position extends Model
{
    protected $fillable = [
        'position_name',
        'position_code'
    ];

    use HasFactory;

    protected static function newPosition($input)
    {
        try {
            Position::create($input);
            return true;
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
}
