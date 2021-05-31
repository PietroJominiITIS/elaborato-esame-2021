<?php

function md5_digest($message) {
    $cmd = "python ../../python/md5.py '$message'";
    $stdout = popen($cmd, "r");
    $digest = fread($stdout, 32);
    fclose($stdout);

    return $digest;
}