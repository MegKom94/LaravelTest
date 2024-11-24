<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhonePlint extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_plint';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'name',
        'id_room',
        'count_port'
    ];
    const DELETED_AT = 'is_deleted';
    public function room()
    {
        return $this->belongsTo(Room::class, 'id');
    }
    public function plintPort()
    {
        return $this->hasMany(PhonePlintPort::class,'id_plint');
    }
}
