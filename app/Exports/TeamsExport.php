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

class TeamsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
        return Team::with(['user', 'member'])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Tim',
            'Instansi',
            'Ketua Tim',
            'No HP Ketua',
            'Anggota Tim',
            'Status Dokumen'
        ];
    }

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

    public function map($team) : array
    {
        // Bikin nomor urut otomatis
        static $no = 1;

        // Gabungkan semua anggota ke dalam satu teks (dipisah koma)
        $memberList = [];
        if ($team->member) {
            foreach ($team->member as $anggota) {
                // Sesuaikan 'phone' atau 'no_telp' dengan field di tabel team_members
                $phone = $anggota->phone ?? $anggota->no_telp ?? '-';
                $memberList[] = $anggota->name . ' (' . $phone . ')';
            }
        }
        $membersString = implode(", ", $memberList);

        // Ubah status jadi bahasa manusia
        if ($team->document){
            $status = match($team->document->status_document){
                'approved' => 'Terverifikasi',
                'rejected' => 'Ditolak',
                default => 'Pending'
            };
        }else {
            $status = 'Pending';
        }

        // Ini adalah urutan data yang dimasukkan ke setiap sel Excel
        return [
            $no++,
            $team->team_name,
            $team->institution,
            $team->user->name ?? 'Belum ada',
            $team->user->no_telp ?? '-', // Sesuaikan jika nama field-nya beda di tabel users
            $membersString,
            $status
        ];
    }
}
