<?
$stack = new SplStack();
$socket = stream_socket_server("tcp://0.0.0.0:1666");
while ($connection = stream_socket_accept($socket, -1)) {
    fwrite($connection, "hello, write value or '0' for get last value\r\n");
    $data = fread($connection, 1024);
    if ($data == 0) {
        $lastMessage = $stack->pop();
        fwrite($connection, "\r\nlast value is $lastMessage \r\n");
    } else {
        $stack->push($data);
        fwrite($connection, "Thank you! Goodbuy!");
    }
    var_dump($data);
    fclose($connection);
}
                                                      