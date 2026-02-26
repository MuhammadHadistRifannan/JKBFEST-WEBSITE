<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeamsExport implements FromCollection, WithHeadings, WithMapping
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
