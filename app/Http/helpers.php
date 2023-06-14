<?php

/**
 * Return the first letter of each word in uppercase.
 *
 * @param string $str
 * @param string $acronym
 * @return string
 */
function str_acronym($str, $acronym = '')
{
    $words = explode(' ', $str);

    foreach ($words as $word)
    {
        $acronym .= mb_strtoupper(mb_substr($word, 0, 1));
    }

    return $acronym;
}

function sig_from_name($str)
{
    $parts = explode(' ',$str);

    return mb_strtoupper($parts[0][0]) . '. ' . ucfirst($parts[1]);
}