<?php

namespace GinoPane\NanoHttpStatus;

/**
 * Class NanoHttpStatus
 *
 * @author Sergey <Gino Pane> Karavay
 */
class NanoHttpStatus implements NanoHttpStatusInterface
{
    /**
     * Default placeholder for non-existent status
     */
    const UNDEFINED_STATUS_MESSAGE = 'Undefined Status';

    /**
     * HTTP status common descriptions
     *
     * @var array
     */
    private static $defaultStatuses = [
        self::HTTP_CONTINUE => 'Continue',
        self::HTTP_SWITCHING_PROTOCOLS => 'Switching Protocols',
        self::HTTP_PROCESSING => 'Processing',
        self::HTTP_EARLY_HINTS => 'Early Hints',
        self::HTTP_OK => 'OK',
        self::HTTP_CREATED => 'Created',
        self::HTTP_ACCEPTED => 'Accepted',
        self::HTTP_NON_AUTHORITATIVE_INFORMATION => 'Non-Authoritative Information',
        self::HTTP_NO_CONTENT => 'No Content',
        self::HTTP_RESET_CONTENT => 'Reset Content',
        self::HTTP_PARTIAL_CONTENT => 'Partial Content',
        self::HTTP_MULTI_STATUS => 'Multi-Status',
        self::HTTP_ALREADY_REPORTED => 'Already Reported',
        self::HTTP_IM_USED => 'IM Used',
        self::HTTP_MULTIPLE_CHOICES => 'Multiple Choices',
        self::HTTP_MOVED_PERMANENTLY => 'Moved Permanently',
        self::HTTP_FOUND => 'Found',
        self::HTTP_SEE_OTHER => 'See Other',
        self::HTTP_NOT_MODIFIED => 'Not Modified',
        self::HTTP_USE_PROXY => 'Use Proxy',
        self::HTTP_TEMPORARY_REDIRECT => 'Temporary Redirect',
        self::HTTP_PERMANENTLY_REDIRECT => 'Permanent Redirect',
        self::HTTP_BAD_REQUEST => 'Bad Request',
        self::HTTP_UNAUTHORIZED => 'Unauthorized',
        self::HTTP_PAYMENT_REQUIRED => 'Payment Required',
        self::HTTP_FORBIDDEN => 'Forbidden',
        self::HTTP_NOT_FOUND => 'Not Found',
        self::HTTP_METHOD_NOT_ALLOWED => 'Method Not Allowed',
        self::HTTP_NOT_ACCEPTABLE => 'Not Acceptable',
        self::HTTP_PROXY_AUTHENTICATION_REQUIRED => 'Proxy Authentication Required',
        self::HTTP_REQUEST_TIMEOUT => 'Request Timeout',
        self::HTTP_CONFLICT => 'Conflict',
        self::HTTP_GONE => 'Gone',
        self::HTTP_LENGTH_REQUIRED => 'Length Required',
        self::HTTP_PRECONDITION_FAILED => 'Precondition Failed',
        self::HTTP_PAYLOAD_TOO_LARGE => 'Payload Too Large',
        self::HTTP_URI_TOO_LONG => 'URI Too Long',
        self::HTTP_UNSUPPORTED_MEDIA_TYPE => 'Unsupported Media Type',
        self::HTTP_RANGE_NOT_SATISFIABLE => 'Requested Range Not Satisfiable',
        self::HTTP_EXPECTATION_FAILED => 'Expectation Failed',
        self::HTTP_I_AM_A_TEAPOT => 'I\'m a teapot',
        self::HTTP_MISDIRECTED_REQUEST => 'Misdirected Request',
        self::HTTP_UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
        self::HTTP_LOCKED => 'Locked',
        self::HTTP_FAILED_DEPENDENCY => 'Failed Dependency',
        self::HTTP_UPGRADE_REQUIRED => 'Upgrade Required',
        self::HTTP_PRECONDITION_REQUIRED => 'Precondition Required',
        self::HTTP_TOO_MANY_REQUESTS => 'Too Many Requests',
        self::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
        self::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable For Legal Reasons',
        self::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
        self::HTTP_NOT_IMPLEMENTED => 'Not Implemented',
        self::HTTP_BAD_GATEWAY => 'Bad Gateway',
        self::HTTP_SERVICE_UNAVAILABLE => 'Service Unavailable',
        self::HTTP_GATEWAY_TIMEOUT => 'Gateway Timeout',
        self::HTTP_VERSION_NOT_SUPPORTED => 'HTTP Version Not Supported',
        self::HTTP_VARIANT_ALSO_NEGOTIATES => 'Variant Also Negotiates',
        self::HTTP_INSUFFICIENT_STORAGE => 'Insufficient Storage',
        self::HTTP_LOOP_DETECTED => 'Loop Detected',
        self::HTTP_NOT_EXTENDED => 'Not Extended',
        self::HTTP_NETWORK_AUTHENTICATION_REQUIRED => 'Network Authentication Required',
    ];

    /**
     * Array of ready-to-use status messages
     *
     * @var string[]
     */
    private $statuses = [];

    public function __construct(array $localize = [])
    {
        $this->statuses = self::$defaultStatuses;

        if (!empty($localize)) {
            $this->statuses = array_intersect_key($localize, $this->statuses) + $this->statuses;
        }
    }

    /**
     * Returns 'true' if status code exists, 'false' otherwise
     *
     * @param int $code
     *
     * @return bool
     */
    public function statusExists(int $code): bool
    {
        return isset($this->statuses[$code]);
    }

    /**
     * Returns relevant status message if status exists, 'Undefined Status' is returned otherwise
     *
     * @param int $code
     *
     * @return string
     */
    public function getMessage(int $code): string
    {
        return $this->statusExists($code) ? $this->statuses[$code] : self::UNDEFINED_STATUS_MESSAGE;
    }

    /**
     * Returns 'true' if status exists and belongs to "informational" (1xx) statuses, 'false' otherwise
     *
     * @param int $code
     *
     * @return bool
     */
    public function isInformational(int $code): bool
    {
        return $this->statusExists($code) && ($this->extractFirstDigit($code) == self::CLASS_INFORMATIONAL);
    }

    /**
     * Returns 'true' if status exists and belongs to "success" (2xx) statuses, 'false' otherwise
     *
     * @param int $code
     *
     * @return bool
     */
    public function isSuccess(int $code): bool
    {
        return $this->statusExists($code) && ($this->extractFirstDigit($code) == self::CLASS_SUCCESS);
    }

    /**
     * Returns 'true' if status exists and belongs to "redirection" (3xx) statuses, 'false' otherwise
     *
     * @param int $code
     *
     * @return bool
     */
    public function isRedirection(int $code): bool
    {
        return $this->statusExists($code) && ($this->extractFirstDigit($code) == self::CLASS_REDIRECTION);
    }

    /**
     * Returns 'true' if status exists and belongs to "client error" (4xx) statuses, 'false' otherwise
     *
     * @param int $code
     *
     * @return bool
     */
    public function isClientError(int $code): bool
    {
        return $this->statusExists($code) && ($this->extractFirstDigit($code) == self::CLASS_CLIENT_ERROR);
    }

    /**
     * Returns 'true' if status exists and belongs to "server error" (5xx) statuses, 'false' otherwise
     *
     * @param int $code
     *
     * @return bool
     */
    public function isServerError(int $code): bool
    {
        return $this->statusExists($code) && ($this->extractFirstDigit($code) == self::CLASS_SERVER_ERROR);
    }

    /**
     * Extracts the first digit of the number
     *
     * @param int $code
     *
     * @return int
     */
    private function extractFirstDigit(int $code): int
    {
        return substr((string)$code, 0, 1);
    }
}
