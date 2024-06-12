<?php

// app/Helpers/helpers.php
if (!function_exists('normalize_string')) {
    function normalize_string($string) {
        // Eliminar todos los caracteres no alfanuméricos y convertir a minúsculas
        return preg_replace('/[^A-Za-z0-9]/', '', strtolower($string));
    }
}
