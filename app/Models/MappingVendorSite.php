<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingVendorSite extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_name',
        'site_id',
        'date',
        'end_date',
        'priority',
    ];
    public $timestamps = false;
}
