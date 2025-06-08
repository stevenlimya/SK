<?php

namespace App\Imports;

use App\Models\Absen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class AbsenImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $indexKe = 1;

        foreach($collection as $row){
            if($indexKe > 1){
                $data['nama']   = !empty($row[0]) ? $row[0] : '';
                $data['checkin']   = !empty($row[1]) ? $row[1] : '';
                $data['checkout']   = !empty($row[2]) ? $row[2] : '';
                $data['tanggal']   = !empty($row[3]) ? $row[3] : '';
                
                Absen::create($data);
            }
            $indexKe++;
        }
    }
}
