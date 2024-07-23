<?php
function validateXSS($input) {
    // Basic XSS validation
    if ($input !== strip_tags($input)) {
        return false;
    }
    return true;
}

function validateSQLInjection($input) {
    // Basic SQL injection validation
    $blacklist = ['/(\b(SELECT|INSERT|UPDATE|DELETE|DROP|ALTER|CREATE|TRUNCATE|EXEC|UNION|ALL)\b)/i', '/(;|\-\-|\[|\]|\{|}|\*|\/|\\\|\\\|)/'];
    foreach ($blacklist as $pattern) {
        if (preg_match($pattern, $input)) {
            return false;
        }
    }
    return true;
}
?>