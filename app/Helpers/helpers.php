<?php

function convert_date($date) {
    return date("j F Y, H:i:s", strtotime($date));
}