<?php
namespace Tests\Mock;

use MvcLite\CCore;

class TestableCCore extends CCore {

    private array $stubbedRows = [];

    public function __construct() {
        // Skip parent __construct entirely — no PdoLite, no CAuth, no CHelper needed
        $this->db    = null;
        $this->ut    = null;
        $this->h     = null;
        $this->Auth  = null;
        $this->Error = null;
    }

    public function willReturn(array $row): void {
        $this->stubbedRows[] = $row;
    }

    protected function fetchRow(string $table, array $options = []): mixed {
        return array_shift($this->stubbedRows);
    }
}