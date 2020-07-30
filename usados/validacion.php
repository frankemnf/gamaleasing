<?php

        $rut= $_POST["rut"];
        $rut = str_replace("-", "", $rut);
        $rut = str_replace(".", "", $rut);
        $nvalidador = substr((string) $rut, -1, 1);
        $rut = substr((string) $rut, 0, -1);
        $cont = 2;
        $d = 1;
        $suma = 0;
        
        if(is_numeric($rut)){
        for ($i = strlen($rut); $i > 0; $i--){
            
            $num = substr((string) $rut, -$d, 1);
            $cadena = $cont * $num;
            $suma = $suma + $cadena;
            $mod = $suma % 11;
            $total = 11 - $mod;

            if ($cont >= 7) {
                $cont = 2;
            } else {
                $cont++;
            }
            $d++;
        }
        if ($nvalidador == "k" || $nvalidador == "K"){
            $nvalidador = 10;
        }
        if ($nvalidador == 0 || $nvalidador == 0) {
            $nvalidador = 11;
        }
        if (@$total != $nvalidador) {
            $resultado[]= array('mensaje' => "Rut Invalido.", 'valido' => 'no');
            echo json_encode($resultado);
        } else {
            if ($nvalidador == 10) {
                $nvalidador = "k";
            }
            if ($nvalidador == 11) {
                $nvalidador = 0;
            }
            $resultado[]= array('rut' => $rut . "-" . $nvalidador, 'valido' => 'si');
            echo json_encode($resultado);
        }
        }  else {
            $resultado[]= array('mensaje' => "Rut Invalido.", 'valido' => 'no');
            echo json_encode($resultado);
        }
        
    

?>