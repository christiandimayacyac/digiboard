<?php
    function redirectTo($url) {
        header('location: ' . URLROOT . '/' . $url);
    }
?>