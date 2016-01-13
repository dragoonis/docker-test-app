<?php
$stagingHostFormat = '%s.staging-server.com';
$map = json_decode(shell_exec('php ' . __DIR__ . '/get-ports-for-nginx.php'), true);
$hostsPortMap = '';
foreach($map as $branch => $portNum) {
    $host = sprintf($stagingHostFormat, $branch);
    $hostsPortMap .= <<<EOF
        {$host} 5000;
EOF;
}

$vhost = file_get_contents(__DIR__ . '/../opt/nginx/staging/multi-site-vhost-template.conf');
$vhost = str_replace('{{hostsPortMap}}', $hostsPortMap, $vhost);
echo $vhost;
exit(0);