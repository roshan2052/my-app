<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents
{
    public function collection()
    {
        return User::all(['id','name','email']);
    }

    public function headings(): array
    {
        return [
            'S.N',
            'Name',
            'Email',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRangeHead = 'A1:C1';
                $cellRangeBorder = 'A1:C2';
                $event->sheet->getDelegate()->getStyle($cellRangeBorder)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
                $event->sheet->getDelegate()->getStyle($cellRangeHead)->applyFromArray(
                    [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['rgb' => 'f1f5f7'],

                        ],
                    ]
                );
            },
        ];
    }
}
