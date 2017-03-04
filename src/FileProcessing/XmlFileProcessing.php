<?php

namespace ThirdBridge\FileProcessing;

class XmlFileProcessing extends AbstractFileProcessing
{
    protected function readFile()
    {
        $this->users = $this->convertToArray(new \SimpleXMLElement(file_get_contents($this->fileName)));
    }

    private function convertToArray(\SimpleXMLElement $obj): array
    {
        $res = [];
        foreach($obj as $user) {
            $aUser['name']   = (string) $user->name[0];
            $aUser['active'] = (bool) ((string)strtolower($user->active[0]) === 'true');
            $aUser['value']  = (int) $user->value[0];
            $res[] = $aUser;
        }

        return $res;
    }
}
