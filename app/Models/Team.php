<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\DelflagScope;

class Team extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new DelflagScope);
    }

    public $timestamps = false;
    protected $fillable = [
        'name',
        'ins_id',
        'upd_id',
        'ins_datetime',
        'upd_datetime',
        'del_flag'
    ];
    protected $primarykey = 'id';
    protected $table = 'm_teams';
    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

}
