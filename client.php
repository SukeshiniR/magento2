<html>
    <body>
        <div align="center"></div>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Enter Message</label>
                        <input type="text" name="msg">
                        <input type="submit" name="btnSend" value="Send">
                    </td>
                </tr>
                <?php
                $host = "127.0.0.1";
                $port = 20205;

                if(isset($_POST['btnSend'])) {
                    $msg = $_REQUEST['msg'];
                    $socket = socket_create(AF_INET, SOCK_STREAM, 0);
                    socket_connect($socket, $host, $port);

                    socket_write($socket, $msg, strlen($msg));

                    $reply = socket_read($socket, 1924);
                    $reply = trim($reply);
                    $reply = "Server says: \t" . $reply;
                }
                ?>
                <tr>
                    <td>
                        <textarea rows="10" cols="30"><?php echo $reply; ?></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>