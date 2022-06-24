<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department',
        'department_code'
    ];

    use HasFactory;

    protected static function newDepartment($input)
    {
        try {
            Department::create($input);
            return true;
        } catch (Exception $ex) {
           throw $ex;
            // return false;
        }
    }

    protected static function upd($input, $id)
    {
        try {
            Department::where('id', $id)
            ->update($input);
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
