<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneGatewayPlint extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_gateway_plint';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'id_port_gateway',
        'id_port_plint'
    ];
    const DELETED_AT = 'is_deleted';
    public function gatewayPort()
    {
        return $this->belongsTo(PhoneGatewayPort::class, 'id');
    }
}
