<?php

    class ImportDbFiasBy extends Step {

        public function run() {
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', '-1');

            if (isset($_GET['install_by'])) {
                $this->install->queryFromFile('by/zone_to_fias_by.sql');
                $this->install->queryFromFile('by/fias_by.sql');
            }

            return !$this->install->getError();
        }
    }
