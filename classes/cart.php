<?php
    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../libraries/Database.php');
    require_once ($filepath.'/../helpers/format.php');
?>

<?php
class Cart  
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    
}

?>