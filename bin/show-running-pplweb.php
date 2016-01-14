#!/usr/bin/env php
<?php
$ret = shell_exec('docker ps --format "{{.ID}} {{.Image}}" | grep pplweb');
$containers = explode("\n", $ret);
$clean = [];
//foreach ($containers as $c) {