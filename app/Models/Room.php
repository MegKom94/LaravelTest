<?php
//add server
namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\MySoftDeleteFlagTrait;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use ConfigurableTrait;
    use MySoftDeleteFlagTrait;
    protected $table = 'room';
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'name',
        'description',
        'places',
        'places_work',
        'floor',
        'build',
        'serial_number',
        'id_type',
        'number',
        'id_dep',
        'owner_id',
        'owner_name',
        'is_workshop',
        'is_show'
    ];
    const DELETED_AT = 'is_deleted';
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'id');
    }
    public function department()
    {
        return $this->belongsTo(RoomType::class, 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function gateway()
    {
        return $this->belongsTo(PhoneGateway::class, 'id_room');
    }
    public function socket()
    {
        return $this->hasMany(PhoneSocket::class,'id_room');
    }
    public function plint()
    {
        return $this->hasMany(PhonePlint::class,'id_room');
    }
}
