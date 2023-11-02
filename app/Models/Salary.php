<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [ 'employee_id' ,'amount','credited_at','description'];
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
}
