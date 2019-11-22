<?php
    function openCon() {
        return mysqli_connect("127.0.0.1", "root", "", "asymmetric");
    }

    function closeCon($con) {
        mysqli_close($con);
    }
?>