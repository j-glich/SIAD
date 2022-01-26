<?php 
 require_once("global.php");
    class Conexion{	  
        public static function Conectar() {        
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
            try{
                $conexion = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME , DB_USERNAME, DB_PASSWORD, $opciones);		
                return $conexion;
            }catch (Exception $e){
                die("El error de Conexión es: ". $e->getMessage());
            }
        }
    }
    ?>
