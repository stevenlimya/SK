<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\Absen;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsenExport implements FromQuery ,WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $query = Absen::query();
        if (!empty($this->startDate) && !empty($this->endDate)) {
            $query->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        }
        $query->select('nama', 'checkin', 'checkout', 'tanggal');
        
        return $query;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Check In',
            'Check Out',
            'Tanggal'
        ];
    }
}
