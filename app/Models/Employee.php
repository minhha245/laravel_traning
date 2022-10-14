<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\DelflagScope;

class Employee extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new DelflagScope);
    }

    public $timestamps =false;
    protected $fillable = [
        'team_id',
        'email',
        'first_name',
        'last_name',
        'gender',
        'password',
        'birthday',
        'address',
        'avatar',
        'salary',
        'position',
        'status',
        'type_of_work',
        'ins_id',
        'upd_id',
        'ins_datetime',
        'upd_datetime',
        'del_flag',
    ];
    protected $primarykey='id';
    protected $table ='m_employees';

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function setGtAttribute()
    {
       return ($this->gender == config('constant.GENDER_MALE')) ? 'Male':'Female';
    }
}
