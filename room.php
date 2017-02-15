<?php
    /*
     *  $type = 0 - Dir
     *  $type = 1 - Files
     */
    function readAll($path, $type){
        if(@is_dir($path) != 1)
            return array();

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

    function readDeep($path, $arr, $targetDepth, $depth){
        $result = readAll($path, 0);
        foreach($result as $key => $value){
            if($depth < $targetDepth){
                $arr[$key] = readDeep($path.$key."/", $arr, $targetDepth, $depth+1);
            }else{
                $arr[$key] = readFiles($path.$key."/");
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

    $Array = readDeep("./Rooms/", array(), 1, 0);

    /*
     * DEFAULT RETURN FUNCTION
     */
    /*
    if(isset($_GET['rooms']) && isset($Array[$_GET['rooms']])){
        if(isset($_GET['date']) && isset($Array[$_GET['rooms']][$_GET['date']]))
            print_r($Array[$_GET['rooms']][$_GET['date']]);
        else
            print_r($Array[$_GET['rooms']]);
    }else
        print_r(array());
    */

    if(isset($_GET['rooms']) && isset($Array[$_GET['rooms']])
            && isset($_GET['date']) && isset($Array[$_GET['rooms']][$_GET['date']])){
        $Array = $Array[$_GET['rooms']][$_GET['date']];
        foreach($Array as $Image){
            echo "<img src=\""."./Rooms/".$_GET['rooms']."/".$_GET['date']."/".$Image."\">";
        }
    }

?>