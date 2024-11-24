<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhonePlintPort extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_plint_port';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'id_plint',
        'name'
    ];
    const DELETED_AT = 'is_deleted';
    public function plint()
    {
        return $this->belongsTo(PhonePlint::class, 'id');
    }
    public function plintPortSocket()
    {
        return $this->hasMany(PhonePlintPortSocket::class,'id_port_plint');
    }

}