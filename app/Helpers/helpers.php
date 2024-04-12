<?php

if (!function_exists('convertMikrotikTimeToSecond')) {
    function convertMikrotikTimeToSecond($uptime)
    {
        preg_match('/(\d+)w(\d+)d(\d+)h(\d+)m(\d+)s/', $uptime, $matches);

        $weeks = $matches[1];
        $days = $matches[2];
        $hours = $matches[3];
        $minutes = $matches[4];
        $seconds = $matches[5];

        $totalSeconds = ($weeks * 7 * 24 * 3600) + ($days * 24 * 3600) + ($hours * 3600) + ($minutes * 60) + $seconds;

        return $totalSeconds;
    }
}

if (!function_exists('avgPing')) {
    function avgPing($ping)
    {
        $num = count($ping);
        return str_replace('ms', '', $ping[$num - 1]['avg-rtt']);
    }
}
