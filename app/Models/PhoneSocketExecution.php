<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneSocketExecution extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_socket_execution';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'id_socket',
        'id_execution',
        'text'
    ];
    const DELETED_AT = 'is_deleted';
    public function form()
    {
        return $this->belongsTo(PhoneSocket::class, 'id');
    }
    public function userExecution()
    {
        return $this->hasMany(UserExecution::class, 'id');
    }
}
