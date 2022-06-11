<?php
$host = "127.0.0.1";
$port = 20205;
set_time_limit(0);

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
$result = socket_listen($socket, 3) or die("Could not setup socket listener\n");
echo "Listening for connecions...";

class Chat
{
    function readline()
    {
        return rtrim(fgets(STDIN));
    }
}

do {
    $accept = socket_accept($socket) or die("Could not accept incoming connection\n");
    $msg = socket_read($accept, 1024) or die("Could not read input\n");

    $msg = trim($msg);
    echo "Client says: \t" . $msg . "\n\n";

    $cht = new Chat();
    echo "Enter reply: \t";
    $resply = $cht->readline();

    socket_write($accept, $resply, strlen($resply)) or die("Could not write output\n");
} while(true);

socket_close($accept, $socket);
