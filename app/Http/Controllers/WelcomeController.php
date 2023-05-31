<?php

namespace App\Http\Controllers;

use App\Entities\DAO\ReferenceApi\Request\ApiRequestDAO;
use App\Entities\DAO\ReferenceApi\Request\CrossRefRequestDAO;
use App\Helpers\Helpers;
use App\Http\Controllers\Request\BaseApiRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Sopamo\LaravelFilepond\Filepond;

class WelcomeController extends BaseController
{

    public function __construct(Request $request)
    {
        //parent::__construct($request);
    }

    protected function index()
    {
        return view('welcome');
    }

    protected function getKeywords(
        $text
    ) {
        if (!$text || $text == "") {
            return [];
        }

        $data = ["q" => $text];
        //return($data);
        // Get keywords from Keywords API
        return self::api(Helpers::KEYWORDS_EXTRACTION_SERVER_URL, $data);
        //return view("welcome", $this->dataParameter);
    }

    protected function getReferences(
        //ApiRequestDAO $apiRequest,
        string $url,
        array $data
    ) {

        /* if (key_exists($apiSource, Helpers::REFERENCE_FREE_API_SOURCES)) {
            $url = Helpers::REFERENCE_FREE_API_SOURCES[$apiSource];
        } else if (key_exists($apiSource, Helpers::REFERENCE_PREMIUM_API_SOURCES)) {
            $url = Helpers::REFERENCE_PREMIUM_API_SOURCES[$apiSource];
        } else {
            $url = Helpers::REFERENCE_FREE_API_SOURCES[Helpers::DEFAULT_REFERENCE_API_SOURCE_KEY];
        } */


        //$data = ["q" => $text];
        var_dump($data);
        //return($data);
        //return 
        // Get references from API Source
        //return self::api($url, $data);
        //return view("welcome", $this->dataParameter);
    }

    protected function manuscriptSupportFromTextOrFile(
        Request $request,
        String $task = BaseApiRequest::API_LLM_STUDENT_TASK_SUMMARIZATION_VALUE
    ) {

        $requestManuscriptFilePath = $request->input(BaseApiRequest::PARAM_MANUSCRIPT_FILE);
        $requestManuscriptText = $request->input(BaseApiRequest::PARAM_MANUSCRIPT_TEXT);

        if ((!$requestManuscriptFilePath || $requestManuscriptFilePath == "") &&
            (!$requestManuscriptText || $requestManuscriptText == "")
        ) {
            return "";
        }

        if ($requestManuscriptFilePath != "") {
            $requestData["file"] = $requestManuscriptFilePath;
        } else {
            $requestData["text"] = $requestManuscriptText;
        }

        $requestData["params"] = $request->input(BaseApiRequest::PARAM_ADDITIONAL_PARAMETERS);
        /* print_r($requestData);
        return($requestData); */

        $responseData = self::api(Helpers::LLM_SERVER_URL . $task, $requestData);
        // echo $responseData;
        $dataKey = BaseApiRequest::API_RESULT_RESOURCE_KEY_DATA;
        $dataParameter["data"] = $responseData->$dataKey;

        switch ($task) {
            case BaseApiRequest::API_LLM_STUDENT_TASK_PROOFREAD_VALUE:
                $dataParameter["requestManuscriptText"] = $responseData->originalText;

                break;
            case BaseApiRequest::API_LLM_STUDENT_TASK_TRANSLATION_VALUE:
                $dataParameter["requestManuscriptText"] = $responseData->originalText;
                $dataParameter["lang"] = $responseData->lang;
                break;

            default:
            $dataParameter["requestManuscriptText"] = $responseData->originalText;
                break;
        }

        $dataToReturn["html"] = view("components.$task-item", $dataParameter)->render();

        return $dataToReturn;
        // Get keywords from Keywords API
        // return self::api(Helpers::KEYWORDS_EXTRACTION_SERVER_URL, $data);
    }


    protected function filePondUploadHandler(
        Request $request
    ) {

        // $requestManuscriptFile = $request->input(BaseApiRequest::PARAM_MANUSCRIPT_FILE);

        // echo "$requestManuscriptFile==+yes";
        // Get the temporary path using the serverId returned by the upload function in `FilepondController.php`
        // $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
        // $filepond = new Filepond();
        // $disk = config('filepond.temporary_files_disk');

        $file = $request->file(BaseApiRequest::PARAM_MANUSCRIPT_FILE);

        $finalDir = public_path('upload/manuscript');
        if (!File::exists($finalDir)) {
            // File::makeDirectory($finalDir);
            File::makeDirectory($finalDir, 0755, true);
        }
        $finalLocation = "$finalDir/paper." . $file->getClientOriginalExtension();
        if (\File::move($file, $finalLocation)) {
            return $finalLocation;
        }
    }

    /* protected function manuscriptSupportFromFile(
        Request $request,
        String $task = BaseApiRequest::API_LLM_STUDENT_TASK_SUMMARIZATION_VALUE
    ) {

        $requestManuscriptFilePath = $request->input(BaseApiRequest::PARAM_MANUSCRIPT_FILE);
    } */


    /*     protected function manuscriptSupportFromFilePond(
        Request $request
    ) {

        $requestManuscriptFile = $request->input(BaseApiRequest::PARAM_MANUSCRIPT_FILE);

        $filepond = new Filepond();
        $response = $filepond->upload();

        return $response->getContent();
    } */

    /*  protected function citeFromAbstract(
        Request $request,
        $apiSourceToUse = CrossRefRequestDAO::API_SOURCE_KEY
    ) {
        $requestAbstract = $request->input(BaseApiRequest::PARAM_ABSTRACT);
        $requestTitle = $request->input(BaseApiRequest::PARAM_TITLE);
        $requestKeywords = $request->input(BaseApiRequest::PARAM_KEYWORDS);
        $requestType = $request->input(BaseApiRequest::PARAM_TYPE);
        $requestField = $request->input(BaseApiRequest::PARAM_FIELD);
        $requestPublisher = $request->input(BaseApiRequest::PARAM_PUBLISHER);
        $requestAuthorsName = $request->input(BaseApiRequest::PARAM_AUTHORS_NAME);
        $requestAuthorsAffiliation = $request->input(BaseApiRequest::PARAM_AUTHORS_AFFILIATION);
        $keywordsList = $this->getKeywords($requestAbstract);
        $keywords = [];
        foreach ($keywordsList as $key => $keyword) {
            $keywords[] = $keyword[0];
        }
        $keywordsImploded = implode("+", $keywords);
        $finalSearchQuery = $keywordsImploded;
        if ($requestTitle || $requestKeywords) {
            $finalSearchQuery = implode("+", [
                $requestTitle, $requestKeywords
            ]);
        }
        //var_dump($finalSearchQuery);

        $referencesApiRequest = new ApiRequestDAO($apiSourceToUse);
        $referencesApiRequest->setQuery($finalSearchQuery);
        $referencesApiRequest->setAuthor($requestAuthorsName);
        $referencesApiRequest->setType($requestType);
        $referencesApiRequest->setPublisher($requestPublisher);
        $referencesApiRequest->setField($requestField);
        $referencesApiRequest->setAuthorAffiliation($requestAuthorsAffiliation);

        //$references = self::getReferences($referencesApiRequest->getUrl(), $referencesApiRequest->getRequestParams());
        $referencesApiResponse = $referencesApiRequest->fetchFromApi();
        $references = $referencesApiResponse->getReferences();
        //var_dump($references);

        $this->dataParameter["references"] = $references;
        $this->dataParameter["apiSourceToUse"] = $apiSourceToUse;
        $dataToReturn["referencesHtml"] = view("components.table-references-row", $this->dataParameter)->render();
        $dataToReturn["referencesAccordionHtml"] = view("components.accordion-references-item", $this->dataParameter)->render();
        $this->dataParameter["tags"] =  $keywords;
        $dataToReturn["keywordsHtml"] = view("components.tags", $this->dataParameter)->render();
        //return json_encode($dataToReturn);
        return $dataToReturn;
    } */


    public static function api($url, $data, $method = "GET")
    {

        $successKey = BaseApiRequest::API_RESULT_RESOURCE_KEY_SUCCESS;
        $resultKey = BaseApiRequest::API_RESULT_RESOURCE_KEY_RESULT;
        $dataKey = BaseApiRequest::API_RESULT_RESOURCE_KEY_DATA;
        //var_dump($data);
        $client = new Client(
            [
                'base_uri' => $url,
                //'verify' => false,
                /* 'headers' => [
                    'Accept' => 'application/json',
                ] */
            ]
        );

        try {
            //$res = $client->get($url . "?q=d n  sds sds",
            //$res = $client->request($method, $url,
            $res = $client->request(
                $method,
                //$url . "?q=d n  sds sds",
                $url,
                /* ['form_params' => [
                $data
            ]] */

                ['query' => $data]
                //['json' => $data]
            );


            //$client = new Client();
            //$res = $client->request($method, $url, [
            //$data
            //]);
            // echo $res->getStatusCode();
            // "200"
            //echo $res->getHeader('content-type')[0];
            // 'application/json; charset=utf8'
            //echo $res->getBody();
            // {"type":"User"...'
            // $res->getBody()->getContents();
            $jsonContent = json_decode($res->getBody()->getContents());

            return $jsonContent->$resultKey;
            // return $jsonContent->$resultKey->$dataKey;
            //return response()->json($jsonContent->$resultKey->$dataKey, $res->getStatusCode());
        } catch (RequestException $e) {
            //var_dump($e);
            var_dump($e->getResponse());
        }
    }
}
