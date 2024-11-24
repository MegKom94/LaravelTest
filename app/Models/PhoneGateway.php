<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneGateway extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_gateway';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'name',
        'ip',
        'ip_out',
        'id_room',
        'count_port'
    ];
    const DELETED_AT = 'is_deleted';
    public function room()
    {
        return $this->hasMany(Room::class, 'id');
    }
}
