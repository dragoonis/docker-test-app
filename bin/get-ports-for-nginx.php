<?php
$ret = shell_exec('docker ps --format "{{.ID}} {{.Image}}"');
$containers = explode("\n", $ret);
$clean = [];
foreach ($containers as $c) {

    if (empty($c)) {
        continue;
    }

    list($containerId, $imageName) = explode(" ", $c);

    // Get Image Tag
    $imageTag = $imageName;
    if (strpos($imageName, ':') !== false) {
        list($imageName, $imageTag) = explode(":", $imageName);
    }

    // Get the inspect info
    $inspectInfo = json_decode(shell_exec(sprintf('docker inspect %s', $containerId)), true);

    if($inspectInfo === false || empty($inspectInfo)) {
        continue;
    }

    $inspectInfo = current($inspectInfo);

    if(!isset($inspectInfo['NetworkSettings']['Ports']) || empty($inspectInfo['NetworkSettings']['Ports'])) {
        continue;
    }

    // Get all the port information
    $portsEntries = $inspectInfo['NetworkSettings']['Ports'];
    $foundPort = false;
    foreach($portsEntries as $ports) {
        if($ports === null || empty($ports)) {
            continue;
        }

        foreach($ports as $port) {
            if(isset($port['HostPort']) && is_numeric($port['HostPort'])) {
                $foundPort = $port['HostPort'];
            }
            break 2; // Pop out 2 loops
        }
    }


    if($foundPort === false) {
        continue;
    }

    $clean[$imageTag] = $foundPort;
}
$output = json_encode($clean);
echo $output;
exit(0);
