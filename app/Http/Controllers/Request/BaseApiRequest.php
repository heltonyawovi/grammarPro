<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Response;

class BaseApiRequest
{
    public const PARAM_MANUSCRIPT_TEXT = "manuscript_text";
    public const PARAM_ADDITIONAL_PARAMETERS = "params";
    public const PARAM_MANUSCRIPT_FILE = "manuscript_file";
    public const API_RESULT_RESOURCE_KEY_RESULT = "result";
    public const API_RESULT_RESOURCE_KEY_SUCCESS = "success";
    public const API_RESULT_RESOURCE_KEY_MESSAGE = "message";
    public const API_RESULT_RESOURCE_KEY_DATA = "data";


    public const API_LLM_STUDENT_TASK_SUMMARIZATION_VALUE = "manuscript-summary"; // - Abstract, title and keyword generation
    public const API_LLM_STUDENT_TASK_PROOFREAD_VALUE = "manuscript-proofread"; // - Proofreading, Grammar check and correction, Reference list correction
    public const API_LLM_STUDENT_TASK_ACCEPTANCE_EVALUATION_VALUE = "manuscript-acceptance-evaluation"; // - Acceptance probability to a given core rank (for conference) or impact factor (for journal)
    public const API_LLM_STUDENT_TASK_SUBMISSION_SUGGESTION_VALUE = "manuscript-submission-suggestion"; // - Journal or conference suggestion where 
    public const API_LLM_STUDENT_TASK_WORD2LATEX_VALUE = "manuscript-word2latex"; // - Word to Latex conversion
    public const API_LLM_STUDENT_TASK_TRANSLATION_VALUE = "manuscript-translation"; // - Manuscript Translation (any language, mainly Japanese to English, English to Japanese)
    public const API_LLM_STUDENT_TASK_REVIEW_SIMULATION_VALUE = "manuscript-review-simulation"; // - Review  simulation (Give work limitations, ask questions…)
    public const API_LLM_STUDENT_TASK_SUPPORT_MATERIAL_GENERATION_VALUE = "manuscript-support-material"; // - Conference presentation material generation
    public const API_LLM_STUDENT_TASK_REFERENCE_CHECKING_VALUE = "manuscript-reference-check"; // - Reference checker (check and correct references)



    public static function sendResponse($result, $message = "", $code = Response::HTTP_OK)
    {
        $response = [
            BaseApiRequest::API_RESULT_RESOURCE_KEY_SUCCESS => true,
            BaseApiRequest::API_RESULT_RESOURCE_KEY_RESULT  => $result,
            BaseApiRequest::API_RESULT_RESOURCE_KEY_MESSAGE => $message,
        ];


        return response()->json($response, $code);
    }

    public static function sendError($error, $errorMessages = [], $code = Response::HTTP_NOT_FOUND)
    {
        $response = [
            BaseApiRequest::API_RESULT_RESOURCE_KEY_SUCCESS => false,
            BaseApiRequest::API_RESULT_RESOURCE_KEY_RESULT => $error,
        ];


        if (!empty($errorMessages)) {
            $response[BaseApiRequest::API_RESULT_RESOURCE_KEY_MESSAGE] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
