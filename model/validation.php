<?php


    function validName($name)
    {
        $name = str_replace(' ', '', $name);
        return !empty($name) && ctype_alpha($name);
    }

    function validAge($age)
    {
        $age = str_replace(' ', '', $age);
        return !empty($age) && ctype_digit($age) && $age <= 118 && $age >= 18;
    }

    function validPhone($phone)
    {
        $phone = str_replace(' ', '', $phone);
        return !empty($phone) && ctype_digit($phone) && sizeof($phone) === 10;
    }

    function validEmail($email)
    {
        $email = str_replace(' ', '', $email);
         return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function validOutdoor($outdoor)
    {
        $outDoorOptions  = getOutdoor();
        return in_array($outdoor, $outDoorOptions);
    }

    function validIndoor($indoor)
    {
        $indoorOptions  = getOutdoor();
        return in_array($indoor, $indoorOptions);
    }
