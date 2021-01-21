<?php
//diese Klasse ermöglicht es Benachrichtigungen im Frontend auszugeben
class NotificationHandler
{
    public $notifications = array();


    //alle Benachrichtigungen werden im Session Array gespeichert und einmalig ausgegeben
    function initAlerts()
    {

        if (isset($_SESSION["alerts"])) {
            
            
        } else {
            $_SESSION["alerts"] = $this->notifications;
        }
    }
    //type = light / secondary /success / danger, fügt eine neue Benachrichtigung ins Session Array ein
    function pushNotification($string, $type)
    {
        $temp = [$string, $type];
        array_push($_SESSION["alerts"], $temp);

    }
    //funktion zur einmaligen Anzeige von allen gespeicherten Benachrichtigungen, inkl. Cleanup danach
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
