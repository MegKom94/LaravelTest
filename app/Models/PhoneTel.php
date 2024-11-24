<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneTel extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'phone_tel';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'number',
        'inner_number',
        'is_cell',
        'is_intercity',
        'is_hidden'
    ];
    const DELETED_AT = 'is_deleted';
    public function gateway()
    {
        return $this->hasMany(PhoneTelGateway::class, 'id_tel');
    }
}
