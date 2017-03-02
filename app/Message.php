<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{

    protected $table = "messages";

    protected $fillable = [
    	'sender_id',
    	'recipient_id',
    	'message'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function recipient() 
    {
    	return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
    
    function created_at()
    {
        $create = $this->created_at;

        $time = time() - $create->timestamp; // to get the time since that moment
        $time = ($time < 1) ? 1 : $time;
        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            if ($time < 604800)
                return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's ago' : ' ago');
            else
                return $this->tanggal($create);
        }
    }

    private function tanggal($str)
    {
        $date=$str->toDateTimeString();
        if ($date != '0000-00-00 00:00:00')
        {
            $BulanIndo = ["Januari", "Februari", "Maret","April", "Mei", "Juni","Juli", "Agustus", "September","Oktober", "November", "Desember"];

            $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
            $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
            $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring

            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        } else
        {
            $result = $date;
        }
        return($result);
    }
}
