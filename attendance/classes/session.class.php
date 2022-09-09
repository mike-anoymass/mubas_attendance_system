<?php

    class Session{
        private static $_sessionStarted = false;

        public static function start(){
            if(self::$_sessionStarted === false){
                session_start();
                self::$_sessionStarted=true;
            }
        }

        public static function set($sessionVariables, $value){
            $_SESSION[$sessionVariables] = $value;
        }

        public static function get($sessionVariables, $key = false){

            if($key == true){
                if(isset($_SESSION[$sessionVariables][$key])){
                    return $_SESSION[$sessionVariables][$key];
                }
            }else if(isset($_SESSION[$sessionVariables])){
                return $_SESSION[$sessionVariables];
            }else{
                return false;
            }

        }

        public static function destroy(){
            if(self::$_sessionStarted === true){
                session_unset();
                session_destroy();
            }
        }
    }

