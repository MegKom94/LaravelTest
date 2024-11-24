<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneTelGateway extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_tel_gateway';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'id_tel',
        'id_port_gateway'
    ];
    const DELETED_AT = 'is_deleted';
    public function phoneTel()
    {
        return $this->belongsTo(PhoneTelGateway::class, 'id');
    }
    public function gatewayPort()
    {
        return $this->hasMany(PhoneGatewayPort::class,'id');
    }
}
