<?php

require_once '../abstract.php';

class Nikinpages_Shell_Nikinpages_Readgooglespreadsheetcontents extends Mage_Shell_Abstract
{
    public function run()
    {
        $content = Mage::getModel('nikinpages_googlespreadsheet/googlespreadsheet')
            ->getGoogleSpreadSheetContents();

        foreach ($content as $row) {
            print_r($row);
            /* Parse the Google Spread Sheet Content and embed your logic here */
        }
    }
}
$shell = new Nikinpages_Shell_Nikinpages_Readgooglespreadsheetcontents();
$shell->run();
