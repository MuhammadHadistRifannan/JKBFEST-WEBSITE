<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KaryaExport implements FromCollection , WithHeadings , WithMapping , ShouldAutoSize , WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Team::whereNotNull('link_karya')->latest('waktu_submit')->get();
    }

    /**
     * @inheritDoc
     */
    public function headings(): array {
        return [
            'No',
            'Nama Tim',
            'Kategori',
            'Link Google Drive',
            'Waktu Submit',
            'Status'
        ];
    }

    /**
     * @inheritDoc
     */
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet) {
        // 1. Ambil baris dan kolom terakhir yang ada datanya
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $cellRange = 'A1:' . $highestColumn . $highestRow;

        // 2. Berikan Border ke seluruh tabel
        $sheet->getStyle($cellRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // 3. Styling khusus untuk baris pertama (Header)
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'], // Teks Putih
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4A154D'], // Background Ungu Custom JKB Fest
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // 4. Center alignment untuk kolom No (A) dan Status (F)
        $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F2:F' . $highestRow)->getAlignment()->setHorizontal('center');

        return [];
    }

    /**
     * @inheritDoc
     */
    public function map($team): array {
        static $rowNumber = 0;
        $rowNumber++;

        $status = $team->waktu_submit ? 'Tepat Waktu' : 'Terlambat';

        return [
            $rowNumber,
            $team->team_name,
            'Web Development', // Bisa diganti $team->kategori jika dinamis
            $team->link_karya,
            $team->waktu_submit, // Pastikan formatnya tanggal/waktu yang valid
        ];
    }
}
