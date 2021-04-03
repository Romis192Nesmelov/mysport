<?php

if ($status) {
    $label = 'success';
    $status = $trueLabel;
} else {
    $label = 'danger';
    $status = $falseLabel;
}
?>

<span class="label label-{{ $label }}">{{ $status }}</span>