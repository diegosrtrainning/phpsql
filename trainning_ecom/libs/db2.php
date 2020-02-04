<?php
    require 'config.php';
    
    function conectar() {
        try
        {
            global $config;
            $host=$config['DB_HOST'];
            $dbname=$config['DB_DATABASE'];    
            $db= new PDO("mysql:host=$host;dbname=$dbname",$config['DB_USERNAME'],$config['DB_PASSWORD']);

            return $db;                
        }catch(PDOException $e)
        {
            throw $e;
        }    
    }
    
    function create($db, $sql, $params) 
    {                    
        $stmt = $db->prepare($sql);    
        try {            
            $stmt->execute($params);
            $id = $db->lastInsertId();            
            return $id;
        } 
        catch(Exception $e) {            
            throw $e;
        }        
    }

    function read($db, $sql) 
    {
        try
        {
            $resultado = [];
            $registrosPDO=$db->query($sql,PDO::FETCH_ASSOC);

            foreach($registrosPDO as $registro) {
                array_push($resultado, $registro);
            }

            return $resultado;

        } catch(PDOException $e)
        {
            throw $e;
        }    
    }    

    function update($db, $sql, $params) 
    {                    
        $stmt = $db->prepare($sql);    
        try {            
            $stmt->execute($params);            
            $linhasAfetadas = $stmt->rowCount();
            return $linhasAfetadas;
        } catch(PDOExecption $e) {
            $db->rollback();
            throw $e;
        }        
    }

    function delete($db, $sql, $params) 
    {                    
        $stmt = $db->prepare($sql);    
        try {            
            $stmt->execute($params);            
            $linhasAfetadas = $stmt->rowCount();
            return $linhasAfetadas;
        } catch(PDOExecption $e) {            
            throw $e;
        }        
    }
?>