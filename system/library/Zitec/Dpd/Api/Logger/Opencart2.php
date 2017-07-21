<?php

class Zitec_Dpd_Api_Logger_Opencart2 extends Zitec_Dpd_Api_Logger_Abstract
{
    public function log($_message)
    {
        $logger = new Log($this->file);
        $logger->write($_message);
        unset($logger);
    }
}