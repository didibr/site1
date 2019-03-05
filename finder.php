<?php
//require_once 'google/vendor/autoload.php';
//require __DIR__ . '/google/vendor/autoload.php';
$gurl='https://www.linkedin.com/jobs/search/?location=Taubat%C3%A9%2C%20S%C3%A3o%20Paulo&locationId=PLACES.br.23-824';
//$file = file_get_contents($gurl, true);	 
//file_put_contents('g.txt',$file);
 //$matches=preg_split('/\s?Description" content="\s?/', $file, -1, PREG_SPLIT_NO_EMPTY); 
 //$matches=preg_split('/\s?"\s?/', $matches[1], -1, PREG_SPLIT_NO_EMPTY); 	 


putenv('GOOGLE_APPLICATION_CREDENTIALS=secret.json');
require 'google/vendor/autoload.php';
use Google\Cloud\Talent\V4beta1\Company;
use Google\Cloud\Talent\V4beta1\CompanyServiceClient;
//$client = new Google_Client();
//$client->setAuthConfig('secret.json');
//$client->useApplicationDefaultCredentials();
//$client->setApplicationName("rational-camera-215416");
//$client->setDeveloperKey("6dc99feb29d68c4bb3a8be972870b64f088c46f0
//0a56df0a80bd38e3f3068641e912eafffadcd6ab");
//$client->addScope(Google_Service_JobService::JOBS);
//$client->useApplicationDefaultCredentials();
//$client->setScopes(array('https://www.googleapis.com/auth/jobs'));






//$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//$client->setRedirectUri($redirect_uri);
//if (isset($_GET['code'])) {
 //   $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//}
//$client->setSubject('audiototext2018@gmail.com');

/*PESQUISA
$service = new Google_Service_Customsearch($client);
$optParams = array('cx' => '004690881561602977136:8kihrfzokms');
$results = $service->cse->listCse("google empregos", $optParams);
foreach ($results->getItems() as $item) {  
	echo $item['htmlTitle'].'<br>';
}
*/


$client = new CompanyServiceClient();
$company=CompanyServiceClient::projectName('rational-camera-215416');
$newCompany=new Company([
        'display_name' => 'Google, LLC',
        'external_id' => 1,
        'headquarters_address' => '1600 Amphitheatre Parkway, Mountain View, CA'
    ]);

$companyServiceClient = new CompanyServiceClient();
$formattedParent = $companyServiceClient->projectName('rational-camera-215416');
$pagedResponse = $companyServiceClient->listCompanies($formattedParent);
    

die();

$companyName='google';
//$jobsService = new Google_Service_JobService($client);
//$optParams = array('filter' => 'companyName=""');
//$jobs = $jobsService->jobs;
//$resp = $jobs->get('ti');


//$jobs->companies->listCompanies();

        $requestMetadata = new Google_Service_JobService_RequestMetadata();
        // Make sure to hash your userID
        $requestMetadata->setUserId('0');
        // Make sure to hash the sessionID
        $requestMetadata->setSessionId('0');
        // Domain of the website where the search is conducted
        $requestMetadata->setDomain('google.com');


        // Perform a search for analyst related jobs
        $jobQuery = new Google_Service_JobService_JobQuery();
        $jobQuery->setLanguageCodes('pt-BR');
        $jobQuery->setCompanyDisplayNames($companyName);
        $jobQuery->setCompanyNames(array($companyName));
        //$jobQuery->setQuery($companyName);

      $searchRequest = new Google_Service_JobService_SearchJobsRequest();
        $searchRequest->setRequestMetadata($requestMetadata);
        $searchRequest->setQuery($jobQuery);
        $searchRequest->setMode('JOB_SEARCH');
        
        //$jobService = self::get_job_service();
        $response = $jobs->search($searchRequest);


$gresp=get_object_vars($response);
var_dump($gresp);
//print_r($response);





?>
