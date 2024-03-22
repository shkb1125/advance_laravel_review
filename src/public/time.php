<?php
$date = new DateTime();
echo $date->format('Y-m-d H:i:s') . '<br>';

echo $date->format(DateTime::ATOM) . '<br>';
echo $date->format(DateTime::COOKIE);