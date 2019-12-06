<?php

function print_unit_select($unit1,$unit2)
{
    if($unit1 == $unit2)
    {
        $result = "<option value='".$unit1."' selected>".$unit1."</option>";
    }else
    {
        $result = "<option value='".$unit1."' >".$unit1."</option>";
    }
    return $result;
}