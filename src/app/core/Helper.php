<?php

class Helper {

    /**
     *
     * @return bool
     */
    public static function isUserLoggedIn(){
        Session::Start();
        return (Session::Get('Id') == 0) ? false : true;
    }

    /**
     *
     * @param $route
     * @return void
     */
    public static function redirectTo($route){
        header("Location: ".$route);
    }

} 