<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Usaha;
use App\Models\Modal as ModalModel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    private function streamCsv(string $filename, array $headerRow, \Closure $writeRows): StreamedResponse
    {
        $callback = function () use ($headerRow, $writeRows) {
            $output = fopen('php://output', 'w');
            // UTF-8 BOM for Excel compatibility
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($output, $headerRow);
            $writeRows($output);
            fclose($output);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }

    public function aset(): StreamedResponse
    {
        $header = ['No', 'Nama Aset', 'Jenis Aset', 'Lokasi', 'Status', 'Tahun', 'Nilai', 'Keterangan'];
        return $this->streamCsv('data_aset.csv', $header, function ($out) {
            $index = 1;
            Aset::orderBy('nama_aset')->chunk(200, function ($rows) use (&$index, $out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $index++, $r->nama_aset, $r->jenis_aset, $r->lokasi, $r->status_kepemilikan,
                        $r->tahun_perolehan, $r->nilai_aset, $r->keterangan,
                    ]);
                }
            });
        });
    }

    public function usaha(): StreamedResponse
    {
        $header = ['No', 'Nama Usaha', 'Jenis Usaha', 'Keterangan', 'Tanggal Dibuat'];
        return $this->streamCsv('data_usaha.csv', $header, function ($out) {
            $index = 1;
            Usaha::orderBy('nama_usaha')->chunk(200, function ($rows) use (&$index, $out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $index++, $r->nama_usaha, $r->jenis_usaha, $r->keterangan, $r->tanggal_dibuat,
                    ]);
                }
            });
        });
    }

    public function modal(): StreamedResponse
    {
        $header = ['No', 'Sumber Modal', 'Jumlah', 'Tanggal Terima', 'Keterangan', 'Tanggal Dibuat'];
        return $this->streamCsv('data_modal.csv', $header, function ($out) {
            $index = 1;
            ModalModel::orderBy('tanggal_terima', 'desc')->chunk(200, function ($rows) use (&$index, $out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $index++, $r->sumber_modal, $r->jumlah, $r->tanggal_terima, $r->keterangan, $r->tanggal_dibuat,
                    ]);
                }
            });
        });
    }
}
