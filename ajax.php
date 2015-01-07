<?php
define('DOCROOT', $_SERVER['DOCUMENT_ROOT'].'/..');
require_once(DOCROOT."/includes/appstart.php");
$allowed_functions = array('get_project_data');

$function = $_SERVER['QUERY_STRING'];

if (in_array($function, $allowed_functions)) {
	$function();
} else {
	die(json_encode(array('error' => 1, 'message' => 'Invalid Function')));	
}

function get_project_data() {
	$project_id = $_POST['project_id'];
	$portfolio_xml = simplexml_load_file('portfolio.xml', NULL, LIBXML_NOCDATA);
	$response = array('error' => 2, 'message' => 'ID not found');
	
	foreach ($portfolio_xml as $project) {
		if (strcasecmp($project->id, $project_id) === 0) {
			// Return only the relevant info
			$response['name'] = (string)$project->name;
			$response['description'] = (string)$project->description;
			$response['url'] = (string)$project->url;
			$response['details'] = array();
			foreach ($project->details->contribution as $detail) {
				$response['details'][] = (string)$detail;
			}
			$response['error'] = 0;
		}
	}

	die(json_encode($response));
}

?>