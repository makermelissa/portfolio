<?php
define('NO_MENU', 1);
define('DOCROOT', $_SERVER['DOCUMENT_ROOT'].'/..');
require_once(DOCROOT."/includes/appstart.php");
define('HEADER', "Melissa's Portfolio");
define('CSS_PAGES', '//cdn.jsdelivr.net/jquery.slick/1.3.11/slick.css');
include_once(DOCROOT."/head.php");
?>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.3.9/slick.min.js"></script>
<script type="text/javascript" src="<?php echo INC_URL; ?>portfolio.js"></script>
<div id="player">
<?php 
$portfolio_xml = simplexml_load_file('portfolio.xml', NULL, LIBXML_NOCDATA);
foreach ($portfolio_xml as $project) {
	if ($project->active == 'true') {
		echo "\t" . '<div id="' . $project->id . '"><img src="/' . IMG_FOLDER  . $project->image . '" alt="' . $project->name . '" /></div>' . "\n";	
	}
}
?>
</div>
<div id="player_description"></div>
<?php
include_once(DOCROOT."/foot.php");
?>