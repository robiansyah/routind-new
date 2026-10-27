<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'spt';

    protected $fillable = [
        'question_id', 'nilai', 'second'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function pay()
    {
        return $this->hasOne(Pay::class, 'ntpn', 'ntpn')->withDefault();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function complete()
    {
        return $this->hasOne(PphComplete::class);
    }

    public function docs()
    {
        return $this->hasMany(PphDoc::class);
    }

    public function spta()
    {
        return $this->hasOne(Spt1770ssA::class, 'spt_id')->withDefault();
    }

    public function sptb()
    {
        return $this->hasOne(Spt1770ssB::class);
    }

    public function sptc()
    {
        return $this->hasOne(Spt1770ssC::class);
    }

    public function spt1a()
    {
        return $this->hasOne(Spt1770s1a::class);
    }

    public function spt1b()
    {
        return $this->hasOne(Spt1770s1b::class);
    }

    public function spt1c()
    {
        return $this->hasMany(Spt1770s1c::class);
    }

    public function spt2a()
    {
        return $this->hasOne(Spt1770s2a::class)->withDefault();
    }

    public function spt2b()
    {
        return $this->hasMany(Spt1770s2b::class);
    }

    public function spt2c()
    {
        return $this->hasMany(Spt1770s2c::class);
    }

    public function spt2d()
    {
        return $this->hasMany(Spt1770s2d::class);
    }

    public function apart()
    {
        return $this->hasOne(Spt1770sApart::class);
    }

    public function header()
    {
        return $this->hasOne(Spt1770sHeader::class);
    }

    public function main()
    {
        return $this->hasOne(Spt1770sMain::class);
    }

    public function ppn()
    {
        return $this->hasOne(PpnInduk::class);
    }

    public function ppnDocs()
    {
        return $this->hasMany(PpnDok::class);
    }

    public function ppnFactur()
    {
        return $this->hasMany(PpnFaktur::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class)->withDefault();
    }

    public function type()
    {
        return $this->belongsTo(SptType::class, 'type_code', 'code')->withDefault();
    }
}
