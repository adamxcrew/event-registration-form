<?php

namespace App\Exports;

use App\Models\Registration;
use Illuminate\Contracts\View\View;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Color;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class RegistrationsExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $registrations;
    protected $events;

    public function __construct($registrations, $events = NULL)
    {
        $this->registrations = $registrations;
        $this->events = $events;
    }

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

                $event->sheet->styleCells('A1:J1', [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => Color::COLOR_BLACK]
                    ]
                ]);

                $event->sheet->styleCells("A2:J" . $event->sheet->getHighestRow(), [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ]
                ]);

                $event->sheet->styleCells("G2:G" . $event->sheet->getHighestRow(), [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ]
                ]);

                $event->sheet->getDelegate()->getStyle('A2:J' . $event->sheet->getHighestRow())->getAlignment()->setWrapText(true);
            },
        ];
    }

    public function collection()
    {
        return Registration::all();
    }

    public function view(): View
    {
        // $registration = $this->registrations;
        return view('exports.registration', [
            'registrations' => $this->registrations,
            'events' => $this->events
        ]);
    }
}
