#!/usr/bin/env php
<?php
$stagingHostFormat = '%s.staging-server.com';
$map = json_decode(shell_exec('php ' . __DIR__ . '/get-tag-to-ports-map.php'), true);
$hostsPortMap = '';
foreach($map as $branch => $portNum) {
    $host = sprintf($stagingHostFormat, $branch);
    $hostsPortMap .= <<<EOF
    {$host} $portNum;
EOF;
}

$vhost = file_get_contents(__DIR__ . '/../opt/nginx/staging/multi-site-vhost-template.conf');
$vhost = str_replace('{{hostsPortMap}}', $hostsPortMap, $vhost);
echo $vhost;
exit(0);