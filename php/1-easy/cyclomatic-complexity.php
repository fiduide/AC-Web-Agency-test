<?php

/**
 * Change if to while.
 * Create  array with unit.
 * Initilize $i = 0 and each time the byte is divided, the unit will increase 
 */
function convertSize($bytes, $precision = 2)
{
  $units = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB", "HB"];
  $i = 0;

  while ($bytes >= 1024 && $i < count($units) - 1) {
    $bytes /= 1024;
    $i++;
  }

  return round($bytes, $precision) . ' ' . $units[$i];
}
