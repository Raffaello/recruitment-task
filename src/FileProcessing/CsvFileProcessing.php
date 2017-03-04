<?php

namespace ThirdBridge\FileProcessing;

class CsvFileProcessing extends AbstractFileProcessing
{
    private const CSV_HEADER = ['name', 'active', 'value'];

    protected function readFile()
    {
        $data = [];
        if (($handle = fopen($this->fileName, "r")) !== FALSE) {
            while (($data[] = fgetcsv($handle, 1000, ",")) !== false) {
            }
            fclose($handle);
        }

        unset($data[count($data)-1]);
        $this->users = $this->parseCsv($data);
    }

    /**
     * @param array $csv
     * @return array
     * @throws \Exception
     */
    private function parseCsv(array $csv): array
    {
        $header = $csv[0];
        // assuming header is fine already ordered.
        // @TODO mapping the header with the expected column
        if (false === $this->checkCsvRequirement($header)) {
            throw new \Exception("csv file format not valid in file {$this->fileName}");
        }

        $res = [];
        for($i = 1; $i < count($csv); $i++) {
            $aRes['name']   = $csv[$i][0];
            $aRes['active'] = strtolower($csv[$i][1]) === 'true';
            $aRes['value']  = $csv[$i][2];
            $res[] = $aRes;
        }

        return $res;
    }

    /**
     * Force to be the same order for now. Mapping feature to be added later.
     *
     * @param array $csvHeader
     * @return bool
     */
    private function checkCsvRequirement(array $csvHeader): bool
    {

        for($i = 0; $i < count(static::CSV_HEADER); $i++) {
            if (static::CSV_HEADER[$i] !== $csvHeader[$i]) {
                return false;
            }
        }

        return true;
    }
}
