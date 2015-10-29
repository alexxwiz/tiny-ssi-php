<?php

class TinySSI {

    private $vars = [];

    private function saveVars($data) {

        $output = preg_replace_callback('|<!--#set var="(.*?)" value="(.*?)" -->|', function ($matches) {
            if (!isset($this->vars[$matches[1]])) {
                $this->vars[$matches[1]] = $matches[2];
            }
            return '';
        }, $data);

        return $output;
    }

    public function parse($filename, $source) {
        $filePath = dirname($filename).'/';
        $parsed = $source;


        $parsed = $this->saveVars($parsed);

        /** #include **/
        $parsed = preg_replace_callback('|<!--#include virtual="(.*?)" -->|', function ($matches) use ($filePath) {
            $output = $this->parse($filePath.$matches[1], file_get_contents($filePath.$matches[1]));
            $output = $this->saveVars($output);

            return $output;
        }, $parsed);

        /** vars - echo **/
        $parsed = preg_replace_callback('|<!--#echo var="(.*?)" -->|', function($matches) {
            return $this->vars[$matches[1]];
        }, $parsed);

        return $parsed;
    }

}

