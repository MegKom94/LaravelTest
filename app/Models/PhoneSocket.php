<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneSocket extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_socket';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'name',
        'id_room'
    ];
    const DELETED_AT = 'is_deleted';
    public function socketExecution()
    {
        return $this->hasMany(PhoneSocketExecution::class, 'id_socket');
    }
    public function room()
    {
        return $this->belongsTo(Room::class,'id');
    }
    public function plintPortSocket()
    {
        return $this->hasMany(PhonePlintPortSocket::class,'id_socket');
    }
}
