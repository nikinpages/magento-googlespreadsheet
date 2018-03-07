<?php
require_once Mage::getBaseDir() . '/vendor/autoload.php';

/**
 * Class Nikinpages_GoogleSpreadsheet_Model_Googlespreadsheet
 */
class Nikinpages_GoogleSpreadsheet_Model_Googlespreadsheet extends Mage_Catalog_Model_Abstract
{
    public $_spreadSheetId;

    public $_spreadSheetRange;

    public $_serviceAccountFile;

    public function __construct()
    {
        $configPath = 'google_api_configuration/googlesheet/';

        $file = Mage::getStoreConfig($configPath . 'service_account_file');

        $this->_spreadSheetId = Mage::getStoreConfig($configPath . 'google_spreadsheet_id');

        $this->_spreadSheetRange = Mage::getStoreConfig($configPath . 'google_spreadsheet_name');

        $this->_serviceAccountFile =  Mage::getBaseDir() . '/var/import/' . $file;
    }

    public function getGoogleSpreadSheetContents()
    {
        try {
            putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $this->_serviceAccountFile);

            $client = new Google_Client();
            $client->useApplicationDefaultCredentials();
            $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

            $service = new Google_Service_Sheets($client);

            $result = $service->spreadsheets_values->get($this->_spreadSheetId, $this->_spreadSheetRange);

            return $result->getValues();

        } catch (Exception $e) {
            echo 'Exception : ' . PHP_EOL;
            print_r($e->getMessage());
        }
    }

}