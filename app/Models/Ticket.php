<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use \Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public static $uidConnection = 'ticket';
    protected $appends = ['uid'];
    protected $fillable = ['price', 'type', 'date', 'capacity', 'origin', 'destination', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('count');
    }
    public function admin()
    {
        return $this->belongsTo(User::class,'allocated_to_admin_id');
    }
    public function getUidAttribute()
    {
        return Hashids::connection('ticket')->encode($this->id);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status','available');
    }

    public function scopeCanceled($query)
    {
        return $query->where('status','canceled');
    }

    public function scopeAdminCanceledTickets($query)
    {
        return $query->where('status','canceled')->where('allocated_to_admin_id',Auth::user()->id);
    }

    public function scopePrice($query,$price_from,$price_to)
    {
        if ($price_from && $price_to){
            return $query->whereBetween('price', [$price_from, $price_to]);
        }
        elseif ($price_from){
            return $query->where('price','>=', $price_from);
        }
        elseif ($price_to){
            return $query->where('price','=<', $price_to);
        }

    }

    public function scopeType($query,$type)
    {
        return $query->where('type',$type);
    }

    public function scopeDepartureDate($query,$date)
    {
        return $query->whereDate('departure_date',Carbon::parse($date));
    }

    public function scopeOrigin($query,$origin)
    {
      return $query->where('origin',$origin);
    }

    public function scopeDestination($query,$destination)
    {
        return $query->where('destination',$destination);
    }

    public function scopeCapacity($query,$capacity)
    {
        return $query->where('capacity','>=',$capacity);
    }
}
