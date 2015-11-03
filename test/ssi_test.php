<?php

require_once('../tiny_ssi.php');

$parser = new \Alexxwiz\TinySSI;
echo $parser->parse('ssi_test_body.html');
