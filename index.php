<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

class Manage {

    public static function autoload($class) {

        include $class . '.php';
    }

}

spl_autoload_register(array('Manage', 'autoload'));

$obj = new main();

class main {

    public function __construct() {
        $pageRequest = 'homepage';

        if (isset($_REQUEST['page'])) {
            $pageRequest = $_REQUEST['page'];
        }

        $page = new $pageRequest;

        $page->post();
    }

}

abstract class page {

    protected $html;

    public function __construct() {
        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="layout.css">';
        $this->html .= '<body>';
    }

    public function __destruct() {
        $this->html .= '</body></html>';
        stringFunctions::printThis($this->html);
    }

    public function post() {
        print_r($_POST);
    }

}

class homepage extends page {

    public function post() {
        require_once './DBConst.php';
        try {
            $connection = new PDO("mysql:host=" . HOST . ";" . "dbname=" . DB, USERNAME, PASSWORD);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $this->html .= "<p>Connected Successfully <br>";
            $sql = "SELECT * FROM accounts WHERE id<6";
            $q = $connection->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $this->html .= "<p>";
            $this->html.=$q->rowCount();
            $this->html .= "</p>";
            $this->html .= '<table border="1">';
            while ($r = $q->fetch()) {
                $this->html .= "<tr>";
                $this->html .= "<td>" . htmlspecialchars($r['id']) . "</td>";
                $this->html .= "<td>" . htmlspecialchars($r['email']) . "</td>";
                $this->html .= "<td>" . htmlspecialchars($r['fname']) . "</td>";
                $this->html .= "<td>" . htmlspecialchars($r['lname']) . "</td>";
                $this->html .= "<td>" . htmlspecialchars($r['phone']) . "</td>";
                $this->html .= "<td>" . htmlspecialchars($r['birthday']) . "</td>";
                $this->html .= "<td>" . htmlspecialchars($r['gender']) . "</td>";
                $this->html .= "<td>" . htmlspecialchars($r['password']) . "</td>";
                $this->html .= "</tr>";
            }
            $this->html .= '</table>';
        } catch (PDOException $e) {
            echo $e->getMessage() . $this->html .= "<br>";
        }
    }

}

class stringFunctions {

    static public function printThis($inputText) {
        return print($inputText);
    }

    static public function stringLength($text) {
        return strLen($text);
    }

}

?>