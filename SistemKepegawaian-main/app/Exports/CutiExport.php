<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\Cuti;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CutiExport implements FromQuery, WithHeadings
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
        $query = Cuti::query();
        if (!empty($this->startDate) && !empty($this->endDate)) {
            $query->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        }
        $query->select('nama', 'divisi', 'keterangan', 'tanggal', 'lama');
        
        return $query;
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Divisi',
            'Keterangan',
            'Tanggal',
            'Lama'
        ];
    }
}
