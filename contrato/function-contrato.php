<?php

function dataTotal($startDate, $endDate)
{

    $diffData = abs(strtotime($endDate) - strtotime($startDate));

    $yearsDiff = floor($diffData / (365 * 60 * 60 * 24));
    $monthsDiff = floor(($diffData - $yearsDiff * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $daysDiff = floor(($diffData - $yearsDiff * 365 * 60 * 60 * 24 - $monthsDiff * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    if ($yearsDiff > 0) {
        return "Anos: " . $yearsDiff . " Meses: " . $monthsDiff . " Dias: " . $daysDiff;
    } else if ($monthsDiff > 0 && $yearsDiff <= 0) {
        return "Meses: " . $monthsDiff . " Dias: " . $daysDiff;
    } else
        return "Dias: " . $daysDiff;
}

function dataDecorrida($startDate, $endDate)
{

    $currentdate = date("Y-m-d");
    $diffData = abs(strtotime($currentdate) - strtotime($startDate));

    $yearsDiff = floor($diffData / (365 * 60 * 60 * 24));
    $monthsDiff = floor(($diffData - $yearsDiff * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $daysDiff = floor(($diffData - $yearsDiff * 365 * 60 * 60 * 24 - $monthsDiff * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    if ($endDate < $currentdate) {
        return "Prazo Finalizado";
    } else if ($startDate > $currentdate) {
        return "Obra ainda não iniciada";
    } else {
        if ($yearsDiff > 0) {
            return "Anos: " . $yearsDiff . " Meses: " . $monthsDiff . " Dias: " . $daysDiff;
        } else if ($monthsDiff > 0 && $yearsDiff <= 0) {
            return "Meses: " . $monthsDiff . " Dias: " . $daysDiff;
        } else
            return "Dias: " . $daysDiff;
    }
}

function dataVencer($endDate)
{

    $currentdate = date("Y-m-d");
    $diffData = abs(strtotime($endDate) - strtotime($currentdate));

    $yearsDiff = floor($diffData / (365 * 60 * 60 * 24));
    $monthsDiff = floor(($diffData - $yearsDiff * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $daysDiff = floor(($diffData - $yearsDiff * 365 * 60 * 60 * 24 - $monthsDiff * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    if ($endDate < $currentdate) {
        return "Prazo Finalizado";
    } else {
        if ($yearsDiff > 0) {
            return "Anos: " . $yearsDiff . " Meses: " . $monthsDiff . " Dias: " . $daysDiff;
        } else if ($monthsDiff > 0 && $yearsDiff <= 0) {
            return "Meses: " . $monthsDiff . " Dias: " . $daysDiff;
        } else
            return "Dias: " . $daysDiff;
    }
}
