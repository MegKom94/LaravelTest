<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhonePlintPortSocket extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_plint_port_socket';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'id_port_plint',
        'id_socket'
    ];
    const DELETED_AT = 'is_deleted';
    public function plintSocket()
    {
        return $this->belongsTo(PhoneSocket::class, 'id');
    }
    public function plintPort()
    {
        return $this->belongsTo(PhonePlintPort::class,'id');
    }
}
