<?php

# Install Script Beta v2

// Run full install if config doesn't exist
if (!file_exists('../../config.php')) {
	header('Location: ./index.php');
	exit;
}

set_error_handler("myErrorHandler");

// Configuration
require_once('../../config.php');

// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Get Path & Url
$errors = array();
$baseurl=(isset($_SERVER['HTTPS']) ? 'https' :'http'). '://' . $_SERVER['HTTP_HOST'] . str_replace('/install','',dirname($_SERVER['REQUEST_URI']));
chdir('..');
$basepath=getcwd();
chdir(dirname(__FILE__));

if (!$link = @mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)) {
	$errors[] = 'Could not connect to the database server using the username and password provided.';
} else {
	if (!@mysql_select_db(DB_DATABASE, $link)) {
		$errors[] = 'The database ' . DB_DATABASE . ' could not be selected, please check if you have permissions, or if it exists on the server.';
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Installation</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<h1>Update Script</h1>
		<div id="container">
<?php

	function myErrorHandler($errno, $errstr, $errfile, $errline) {
    	echo "LINE $errline: [$errno] $errstr<br/>";
        return;
    }

	if (empty($errors)) {
		// Run install script
		$file='install.sql';
		if (!file_exists($file)) {
			$errors[] = 'SQL file ' . $file . ' could not be found.';
		} else {
			mysql_query('set character set utf8', $link);
			if ($sql=file($file)) {
				$query = '';
				foreach($sql as $line) {

					// Hacks for compatibility (needs to be improved)
					$line = str_replace("PREFIX_", DB_PREFIX, $line);
					$line = str_replace(" order ", " `order` ", $line);
					$line = str_replace(" ssl ", " `ssl` ", $line);
					$line = str_replace("NOT NULL DEFAULT ''", "NOT NULL", $line);
					$line = str_replace("NOT NULL DEFAULT NULL", "NOT NULL", $line);
					$line = str_replace("NOT NULL DEFAULT 0 COMMENT '' auto_increment", "NOT NULL COMMENT '' auto_increment", $line);
					$line = trim($line);
					//$line = str_replace(";", "", $line);

					if ((substr(trim($line), 0, 2) == '--') || (substr(trim($line), 0, 1) == '#')) { continue; }
					if (preg_match('/^ALTER TABLE (.+?) ADD PRIMARY KEY/', $line, $matches)) {
						$res = mysql_query(sprintf("SHOW KEYS FROM %s",$matches[1]), $link);
						$info = mysql_fetch_assoc(mysql_query(sprintf("SHOW KEYS FROM %s",$matches[1]), $link));
						if ($info['Key_name'] == 'PRIMARY') { continue; }
					}
					if (preg_match('/^ALTER TABLE (.+?) ADD (.+?) /', $line, $matches)) {
						if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[1],str_replace('`', '', $matches[2])), $link)) > 0) { continue; }
					}
					if (preg_match('/^ALTER TABLE (.+?) DROP (.+?) /', $line, $matches)) {
						if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[1],str_replace('`', '', $matches[2])), $link)) <= 0) { continue; }
					}
					if (preg_match('/INNER JOIN (.+?) /', $line, $matches)) {
						$xx = @mysql_query(sprintf("SHOW TABLES LIKE '%s'", str_replace('`', '', $matches[1])), $link);
						if ($xx && mysql_num_rows($xx) <= 0) { continue; }
					}
					if (preg_match('/^DROP TABLE (.+?);/', $line, $matches)) {
						if (preg_match('/^DROP TABLE IF EXISTS (.+?);/', $line, $matches2)) {
							//if (mysql_num_rows(@mysql_query(sprintf("DESC %s", str_replace('`', '', $matches2[1])), $link)) <= 0) { continue; }
						} else {
							if (mysql_num_rows(@mysql_query(sprintf("SHOW TABLES LIKE '%s'", str_replace('`', '', $matches[1])), $link)) <= 0) { continue; }
						}
					}
					if (strpos($line, 'ALTER TABLE') !== FALSE && strpos($line, 'DROP') !== FALSE && strpos($line, 'PRIMARY') === FALSE) {
						$params = explode(' ', $line);
						if ($params[3] == 'DROP') {
							if (mysql_num_rows(@mysql_query("SHOW COLUMNS FROM $params[2] LIKE '$params[4]'", $link)) <= 0) { continue; }
						}
					}
					if (preg_match('/^ALTER TABLE ([^\s]+) DEFAULT (.+?) /', $line, $matches)) {
						if (mysql_num_rows(@mysql_query(sprintf("SHOW TABLES LIKE '%s'", str_replace('`', '', $matches[1])), $link)) <= 0) { continue; }
					}
					if (preg_match('/^ALTER TABLE (.+?) MODIFY (.+?) /', $line, $matches)) {
						if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[1],str_replace('`', '', $matches[2])), $link)) <= 0) { continue; }
					}
					if (preg_match('/^ALTER TABLE (.+?) CHANGE (.+?) (.+?) /', $line, $matches)) {
						if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[1],str_replace('`', '', $matches[2])), $link)) <= 0) {
							continue;
						}

						// if it does exist, be sure the new name doesn't also exist. If so, then just delete it.
						if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[1],str_replace('`', '', $matches[3])), $link)) > 0) {
							@mysql_query(sprintf("ALTER TABLE %s DROP %s", $matches[1], str_replace('`', '', $matches[2])), $link); //Drop the column if it was supposed to be changed to a column that already exists
							continue;
						}
					}
					if (preg_match('/^DELETE FROM (.+?) WHERE (.+?) /', $line, $matches)) {
						if (preg_match('~ WHERE (.*);$~', $line, $matches2)) {
							if (preg_match_all('~`([^`]+)`~', $matches2[1], $matched)) {
								$notfound = 0;
								foreach ($matched[1] as $m) {
									if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[1],str_replace('`', '', $m)), $link)) <= 0) {
										$notfound++;
									}
								}
								if ($notfound) { continue; }
							}
						}
					}
					if (preg_match('/^INSERT INTO (.+?) \(([^)]+)\) /', $line, $matches)) {
						$parts = explode(",", str_replace("`", "", $matches[2]));
						$notfound = 0;
						foreach ($parts as $m) {
							if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[1], trim($m)), $link)) <= 0) {
								$notfound++;
							}
						}
						if ($notfound) { continue; }
					}
					if (preg_match('/^INSERT INTO (.+?) \(([^)]+)\) SELECT ([^FROM]+) FROM `([^`]+)`/', $line, $matches)) {
						$parts = explode(",", str_replace("`", "", $matches[3]));
						$notfound = 0;
						foreach ($parts as $m) {
							if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'", $matches[4], trim($m)), $link)) <= 0) {
								$notfound++;
							}
						}
						if ($notfound) { continue; }
					}
					//if (preg_match('/^ALTER TABLE (.+?) DEFAULT (.+?) /',$line,$matches)) {
					//	if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'",$matches[1],str_replace('`','',$matches[2])), $link)) <= 0) { continue; }
					//}
					//if (preg_match('/^ALTER TABLE (.+?) ALTER (.+?) /',$line,$matches)) {
					//	if (mysql_num_rows(@mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE '%s'",$matches[1],str_replace('`','',$matches[2])), $link)) <= 0) { continue; }
					//}

					if (!empty($line)) {
						$query .= $line;
						if (preg_match('/;\s*$/', $line)) {
							if (mysql_query($query, $link) === false) {
								$errors[] = 'Could not execute this query: ' . $query . ' ' . mysql_error($link);
							}
							$query = '';
						}
					}
				}
			}
		}
	}

	if (!empty($errors)) { //has to be a separate if
		?>
		<p>The following errors occured:</p>
		<?php foreach ($errors as $error) {?>
		<div class="warning"><?php echo $error;?></div><br />
		<?php } ?>
		<p>Please contact the author on email contact@wedoweb.com.au quoting the above errors for support!</p>
		</div>
<?php } else { ?>
		<h2>The extension has been updated successfully</h2>
<?php } ?>
		<div class="center"><a href="http://www.opencart.com/">OpenCart.com</a></div>
	</body>
</html>