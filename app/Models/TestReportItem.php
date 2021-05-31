<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReportItem extends Model
{
    use HasFactory;

    public $table = 'test_report_items';

    protected $fillable = [
        'test_id',
        "title",
        'initialNormalValue',
        'finalNormalValue',
        'firstCriticalValue',
        'finalCriticalValue',
        'unit',
    ];

    public function TestReport(){
        return $this->hasOne(TestReport::class );
    }
}
