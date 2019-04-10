<?php

namespace App\Exports;

use App\Models\Registration;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class RegistrationsExport implements FromView, ShouldAutoSize, WithHeadings, WithMapping, WithEvents
{
    public function registerEvents(): array
    {
        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });

        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->styleCells('A1:E1', [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]
                ]);
            },
        ];
    }

    public function collection()
    {
        return Registration::all();
    }

    public function map($registration): array
    {
        return [
            $registration->id,
            $registration->code,
            $registration->created_at->format('d/m/Y'),
            $registration->user->participant->name,
            $registration->user->participant->phone
        ];
    }

    public function headings(): array
    {
        return [
            'No.',
            'Registrasi',
            'Tanggal',
            'Peserta',
            'Kontak'
        ];
    }

    public function view(): View
    {
        return view('exports.registration', [
            'registrations' => Registration::orderBy('created_at', 'desc')->get()
        ]);
    }
}
