<?php

class Session
{
     /**
      * Start session
      */
      public static function start()
      {
        session_start();
      }

     /**
      * Set $_SESSION variables
      * @param string $key
      * @param mixed $value
      */
      public static function set($key, $value)
      {
        $_SESSION[$key] = $value;
      }

     /**
     * Get $_SESSION variables
     * @param string $key
     * @return mixed
     */
      public static function get($key)
      {
        if(isset($_SESSION[$key])) return $_SESSION[$key];
      }

    /**
     * Delete variable from $_SESSION
     * @param string $key
     */
      public static function remove($key)
      {
        unset($_SESSION[$key]);
      }

    /**
     * Destroy session
     */
      public static function destroy()
      {
        session_destroy();
      }

}
