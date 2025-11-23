<?php
// 10. Trait
namespace PerpustakaanOOP\Traits;

trait TimestampTrait {
    private string $tanggalDibuat;
    private string $tanggalDiupdate;

    public function setTimestamp(): void {
        $this->tanggalDibuat = date('Y-m-d H:i:s');
        $this->tanggalDiupdate = $this->tanggalDibuat;
    }

    public function getTanggalDibuat(): string {
        return $this->tanggalDibuat;
    }
}