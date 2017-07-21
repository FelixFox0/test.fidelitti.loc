<?php

    class ImportDbFiasKz extends Step {

        public function run() {

            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', '-1');

            if (isset($_GET['install_kz'])) {
                $this->install->queryFromFile('kz/zone_to_fias_kz.sql');
                $this->install->queryFromFile('kz/fias_kz.sql');
            }

            return !$this->install->getError();
        }
    }
