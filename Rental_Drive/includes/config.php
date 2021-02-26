<?php 
	// DB credentials.
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','carrental');

	// Establish database connection.
	try
	{
		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	} catch (PDOException $e) {
		exit("Error: " . $e->getMessage());
	}

	function dd($data, $terminate = 0) {
        // Pretty print
        if(is_bool($data)) {
            echo $data ? 'true' : 'false';
            echo '<br/>';
        }

        if(is_string($data)) {
            echo $data;
            echo '<br/>';
        }

        if(is_array($data) || is_object($data)) {
            print("<pre>".print_r($data,true)."</pre>");
        }

        if($terminate === 1) {
            die;
        }
    }

	function humanReadableDate($date) {
		return date('F jS\, Y', strtotime($date));
	}

	function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  }

	  return $text;
	}
?>