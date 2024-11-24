<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneGatewayPort extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_gateway_port';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'id_gateway',
        'name'
    ];
    const DELETED_AT = 'is_deleted';
    public function gateway()
    {
        return $this->belongsTo(PhoneTelGateway::class, 'id_port_gateway');
    }
    public function gatewayPlint()
    {
        return $this->hasMany(PhoneGatewayPlint::class, 'id_port_gateway');
    }
}
