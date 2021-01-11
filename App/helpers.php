<?php

function formatDate($dateString) {
  $monthsList = array("01" => "января", "02" => "февраля",
  "03" => "марта", "04" => "апреля", "05" => "мая", "06" => "июня", 
  "07" => "июля", "08" => "августа", "09" => "сентября",
  "10" => "октября", "11" => "ноября", "12" => "декабря");

  $dateArray = explode(".", $dateString);
  $yearAndDate = explode(" ", $dateArray[2]);
  $yearAndDate[0] .= " в ";
  $dateArray[2] = implode("", $yearAndDate);
  $dateArray[1] = $monthsList[$dateArray[1]];
  
  $date = implode(" ", $dateArray);
  return $date;
}