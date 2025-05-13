<?php 

function formatRupiah($angka)
{
    return "Rp. " . number_format($angka, 0, ',', '.');
}

function formatId($id) {
    $split = explode('-', $id);
    $combineSplits = $split[0].$split[1].$split[2].$split[3].$split[4];
    $numberOnly = preg_replace('/[^0-9]/', '', $combineSplits);
    
    return $numberOnly;
}