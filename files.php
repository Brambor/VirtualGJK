<?php

    error_reporting(0);

    /*
     *  $type = 0 - Dir
     *  $type = 1 - Files
     */
    function readAll($path, $type){
        if(@is_dir($path) != 1)
            print_r(json_encode(array()));

        $Files = array_diff(scandir($path), array('..', '.'));
        $Response = array();
        foreach($Files as $File){
            if(@is_dir($path.$File) != 1 && $type === 1)
                $Response[$File] = null;
            if(@is_dir($path.$File) == 1 && $type === 0)
                $Response[$File] = null;
        }
        return $Response;
    }
    
    function readDeep($path, $arr, $depth, $targetDepth){
        $Files = readAll($path, 0);
        foreach ($Files as $File => $None){
            if($depth < $targetDepth){
                $arr[$File] = readDeep($path.$File."/", array(), $depth + 1, $targetDepth);
            }else{
                $arr[$File] = readFiles($path.$File."/");
            }
        }
        return $arr;
    }

    function readFiles($path){
        $result = readAll($path, 1);
        $response = array();
        foreach($result as $key => $value){
            array_push($response, $key);
        }
        return $response;
    }

    $Array = readDeep("./Rooms/", array(), 0, 1);
    
    /*
     * DEFAULT RETURN FUNCTION
     */
    if(isset($_GET['room']) && isset($Array[$_GET['room']]))
        print_r(json_encode($Array[$_GET['room']]));
    else
        print_r(json_encode(array()));
?>