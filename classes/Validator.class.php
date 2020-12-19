<?php

class Validator{





function validate_string($varName){      

        $varName = $_POST[$varName];
        $varName =htmlspecialchars($varName);
        $varname = trim($varName);
        return $varName;
}

function validate_Password($PW){      

    $PW  =  hash("sha256",$PW);
            return $PW;
        
    }
    
}
?>
