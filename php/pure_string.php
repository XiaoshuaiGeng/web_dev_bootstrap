<?php

    function mysql_entities_fix_string($connection, $string)
    {

        $string = stripslashes($string);
        $string = strip_tags($string);

        return $connection->real_escape_string($string);
    }