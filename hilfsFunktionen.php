<?php
    function testeEingabe($eingabe)
    {
        $eingabe = trim($eingabe);
        $eingabe = stripslashes($eingabe);
        $eingabe = htmlspecialchars($eingabe);
        return $eingabe;
    }
?>