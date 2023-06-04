<?php
class Lapangan {
    private $jenis;
    private $hargaSewa;
    private $pesanan = array();

    public function __construct($jenis, $hargaSewa) {
        $this->jenis = $jenis;
        $this->hargaSewa = $hargaSewa;
    }

    public function cekWaktu($tanggal, $jamMulai, $jamSelesai) {
        foreach ($this->pesanan as $p) {
            if ($p['tanggal'] == $tanggal && $this->jamOverlap($p['jam_mulai'], $p['jam_selesai'], $jamMulai, $jamSelesai)) {
                return true;
            }
        }

        return false;
    }

    public function pesanLapangan($nama, $tanggal, $jamMulai, $jamSelesai) {
        $pesanan = array('nama' => $nama, 'tanggal' => $tanggal, 'jam_mulai' => $jamMulai, 'jam_selesai' => $jamSelesai);
        $this->pesanan[] = $pesanan;
    }

    public function hitungHarga($durasi) {
        $totalHarga = count($this->pesanan) * $this->hargaSewa * $durasi;
        return $totalHarga;
    }

    public function hitungDurasi($jamMulai, $jamSelesai) {
        $mulai = new DateTime($jamMulai);
        $selesai = new DateTime($jamSelesai);
        $durasi = $mulai->diff($selesai);
        return $durasi->h;
    }
    private function jamOverlap($start1, $end1, $start2, $end2) {
        $range1 = range(strtotime($start1), strtotime($end1), 15 * 60);
        $range2 = range(strtotime($start2), strtotime($end2), 15 * 60);

        foreach ($range1 as $time1) {
            if (in_array($time1, $range2)) {
                return true;
            }
        }

        return false;
    }
}
?>