<?php

    class mysql_db{
        //+======================================================+
        function sql_connect($sqlserver, $sqluser, $sqlpassword, $database){
            $this->connect_id = mysql_connect($sqlserver, $sqluser, $sqlpassword);
            if($this->connect_id){
                if (mysql_select_db($database)){
                    return $this->connect_id;
                }else{
                    return $this->error();
                }
            }else{
                return $this->error();
            }
        }
        //+======================================================+
        function error(){
            if(mysql_error() != ''){
                echo '<b>DB Error</b>: '.mysql_error().'<br/>';
            }
        }
        //+======================================================+
        function query($query){
            if ($query != NULL){
                $this->query_result = mysql_query($query, $this->connect_id);
                if(!$this->query_result){
                    return $this->error();
                }else{
                    return $this->query_result;
                }
            }else{
                return '<b>DB Error</b>: Empty Query!';
            }
        }
        //+======================================================+
        function get_num_rows($query_id = ""){
            if($query_id == NULL){
                $return = mysql_num_rows($this->query_result);
            }else{
                $return = mysql_num_rows($query_id);
            }
            if(!$return){
                $this->error();
            }else{
                return $return;
            }
        }
        //+======================================================+
        function fetch_row($query_id = ""){
            if($query_id == NULL){
                $return = mysql_fetch_array($this->query_result);
            }else{
                $return = mysql_fetch_array($query_id);
            }
            if(!$return){
                $this->error();
            }else{
                return $return;
            }
        }   
        //+======================================================+
        function get_affected_rows($query_id = ""){
            if($query_id == NULL){
                $return = mysql_affected_rows($this->query_result);
            }else{
                $return = mysql_affected_rows($query_id);
            }
            if(!$return){
                $this->error();
            }else{
                return $return;
            }
        }
		 //+======================================================+
		 function sql_id(){
		 
		 return mysql_insert_id();
		 
		 }
        //+======================================================+
        function sql_close(){
            if($this->connect_id){
                return mysql_close($this->connect_id);
            }
        }
        //+======================================================+   
		
    }


?>
