<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\Resain;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ResainExport implements FromQuery, WithHeadings
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
        $query = Resain::query();
        if (!empty($this->startDate) && !empty($this->endDate)) {
            $query->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        }
        $query->select('nama', 'divisi', 'tanggal');
        
        return $query;
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Divisi',
            'Tanggal Resain'
        ];
    }
}
