<?php

namespace ThirdBridge\FileProcessing;

use Symfony\Component\Yaml\Yaml;

class YmlFileProcessing extends AbstractFileProcessing
{
    protected function readFile()
    {
        $res = Yaml::parse(file_get_contents($this->fileName));
        $this->users = $res['users'];
    }
}
