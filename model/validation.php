<?php


    function validName($fname,$lname)
    {
        $fname = str_replace(' ', '', $fname);
        $lname = str_replace(' ', '', $lname);

        return !empty($fname) && !empty($lname) && ctype_alpha($fname) && ctype_alpha($lname);
    }

    function validAge($age)
    {
        $age = str_replace(' ', '', $age);
        return !empty($age) && ctype_digit($age) && $age <= 118 && $age >= 18;
    }

    function validPhone($phone)
    {
        $phone = str_replace(' ', '', $phone);
        return !empty($phone) && ctype_digit($phone) && strlen($phone) === 10;
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
