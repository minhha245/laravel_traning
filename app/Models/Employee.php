<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $fillable = [
        'team_id',
        'email',
        'fisrt_name',
        'last_name',
        'gender',
        'birthday',
        'address',
        'avatar',
        'salary',
        'positon',
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

}