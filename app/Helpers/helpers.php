<?php

function convertMobileFormatWithOut98($value): array|string
{
    return str_replace('+98', '0', $value);
}
