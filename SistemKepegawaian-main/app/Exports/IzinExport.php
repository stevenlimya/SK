<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\Izin;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IzinExport implements FromQuery, WithHeadings
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
        $query = Izin::query();
        if (!empty($this->startDate) && !empty($this->endDate)) {
            $query->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        }
        $query->select('nama', 'divisi', 'keterangan', 'tanggal', 'status' , 'lama');
        
        return $query;
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Divisi',
            'Keterangan',
            'Tanggal',
            'Status',
            'Lama'
        ];
    }
}
