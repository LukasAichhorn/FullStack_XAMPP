<?php
class NotificationHandler
{
    public $notifications = array();



    function initAlerts()
    {

        if (isset($_SESSION["alerts"])) {
            
            
        } else {
            $_SESSION["alerts"] = $this->notifications;
        }
    }
    //type = light / secondary /success / warning
    function pushNotification($string, $type)
    {
        $temp = [$string, $type];
        array_push($_SESSION["alerts"], $temp);

    }

    function display()
    {
        $this->notifications = $_SESSION["alerts"];
        foreach ($this->notifications as $notification) {
            echo ('
                <div class="alert alert-' . $notification[1] . ' alert-dismissible fade show" role="alert">
                    '. $notification[0] .'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> 
        ');
        }

        unset($_SESSION["alerts"]);
    }
}
