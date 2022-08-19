<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JumlahExport implements FromCollection, WithHeadings
{
    protected $data;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings() :array
    {
        return [
            'Bulan',
            'Tahun',
            'Jumlah Invoice',
            'Invoice Terbayar',
            'Invoice Belum Dibayar',
            'Invoice Tidak Dibayar',
            'Total Invoice',
            'Invoice Terbayar(Rp)',
            'Invoice Belum Dibayar(Rp)',
            'Invoice Tidak Dibayar(Rp)',
        ];
    }
}
