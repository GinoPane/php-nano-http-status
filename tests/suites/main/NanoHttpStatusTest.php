<?php

namespace GinoPane\NanoHttpStatus;

use Generator;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class NanoHttpStatusTest
 *
 * @author Sergey <Gino Pane> Karavay
 */
class NanoHttpStatusTest extends TestCase
{
    /**
     * Just check if the YourClass has no syntax errors
     */
    public function testIsThereAnySyntaxError()
    {
        $object = new NanoHttpStatus();

        $this->assertTrue($object instanceof NanoHttpStatus);
    }

    /**
     * @dataProvider getAllValidStatusConstants
     *
     * @param int $code
     */
    public function testIfAllStatusCodesExist(int $code)
    {
        $this->assertTrue((new NanoHttpStatus())->statusExists($code));
    }

    /**
     * @dataProvider getInformationalCodes
     *
     * @param int $code
     */
    public function testIfInformationalCodesAreDetected(int $code)
    {
        $this->assertTrue((new NanoHttpStatus())->isInformational($code));
    }

    /**
     * @dataProvider getSomeInvalidStatusConstants
     *
     * @param int $code
     */
    public function testIfNonInformationalCodesAreDetectedWithNonExistent(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isInformational($code));
    }

    /**
     * @dataProvider getClientErrorCodes
     *
     * @param int $code
     */
    public function testIfNonInformationalCodesAreDetectedWithAnotherClass(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isInformational($code));
    }

    /**
     * @dataProvider getSuccessCodes
     *
     * @param int $code
     */
    public function testIfSuccessCodesAreDetected(int $code)
    {
        $this->assertTrue((new NanoHttpStatus())->isSuccess($code));
    }

    /**
     * @dataProvider getSomeInvalidStatusConstants
     *
     * @param int $code
     */
    public function testIfNonSuccessCodesAreDetectedWithNonExistent(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isSuccess($code));
    }

    /**
     * @dataProvider getClientErrorCodes
     *
     * @param int $code
     */
    public function testIfNonSuccessCodesAreDetectedWithAnotherClass(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isSuccess($code));
    }

    /**
     * @dataProvider getRedirectionCodes
     *
     * @param int $code
     */
    public function testIfRedirectionCodesAreDetected(int $code)
    {
        $this->assertTrue((new NanoHttpStatus())->isRedirection($code));
    }

    /**
     * @dataProvider getSomeInvalidStatusConstants
     *
     * @param int $code
     */
    public function testIfNonRedirectionCodesAreDetectedWithNonExistent(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isRedirection($code));
    }

    /**
     * @dataProvider getClientErrorCodes
     *
     * @param int $code
     */
    public function testIfNonRedirectionCodesAreDetectedWithAnotherClass(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isRedirection($code));
    }

    /**
     * @dataProvider getClientErrorCodes
     *
     * @param int $code
     */
    public function testIfClientErrorCodesAreDetected(int $code)
    {
        $this->assertTrue((new NanoHttpStatus())->isClientError($code));
    }

    /**
     * @dataProvider getSomeInvalidStatusConstants
     *
     * @param int $code
     */
    public function testIfNonClientErrorCodesAreDetectedWithNonExistent(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isClientError($code));
    }

    /**
     * @dataProvider getServerErrorCodes
     *
     * @param int $code
     */
    public function testIfNonClientErrorCodesAreDetectedWithAnotherClass(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isClientError($code));
    }

    /**
     * @dataProvider getServerErrorCodes
     *
     * @param int $code
     */
    public function testIfServerErrorCodesAreDetected(int $code)
    {
        $this->assertTrue((new NanoHttpStatus())->isServerError($code));
    }

    /**
     * @dataProvider getSomeInvalidStatusConstants
     *
     * @param int $code
     */
    public function testIfNonServerErrorCodesAreDetectedWithNonExistent(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isServerError($code));
    }

    /**
     * @dataProvider getClientErrorCodes
     *
     * @param int $code
     */
    public function testIfNonServerErrorCodesAreDetectedWithAnotherClass(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->isServerError($code));
    }

    /**
     * @dataProvider getSomeInvalidStatusConstants
     *
     * @param int $code
     */
    public function testIfSomeStatusCodesDontExist(int $code)
    {
        $this->assertFalse((new NanoHttpStatus())->statusExists($code));
    }

    /**
     * @dataProvider getDefaultStatusMessages
     *
     * @param int $code
     * @param string $expectedMessage
     */
    public function testIfStatusMessagesAreFetchedCorrectly(int $code, string $expectedMessage)
    {
        $this->assertEquals($expectedMessage, (new NanoHttpStatus())->getMessage($code));
    }

    /**
     * @dataProvider getSomeInvalidStatusConstants
     *
     * @param int $code
     */
    public function testIfUndefinedStatusIsReturnedForInvalidCode(int $code)
    {
        $this->assertEquals('Undefined Status', (new NanoHttpStatus())->getMessage($code));
    }

    public function testIfLocalizationArrayReplacesMessages()
    {
        $status = new NanoHttpStatus([
            400 => 'Very bad request',
            502 => 'Not so bad gateway'
        ]);

        $this->assertEquals('Very bad request', $status->getMessage(400));
        $this->assertEquals('Not so bad gateway', $status->getMessage(502));
    }

    /**
     * @return Generator
     */
    public function getAllValidStatusConstants()
    {
        $class = new ReflectionClass(NanoHttpStatusInterface::class);

        foreach ($class->getConstants() as $constant => $value) {
            if (stripos($constant, 'http_') === 0) {
                yield [$value];
            }
        }
    }

    /**
     * @return array
     */
    public function getSomeInvalidStatusConstants()
    {
        return [
            [0],
            [1],
            [131],
            [225],
            [331],
            [445],
            [522],
            [601]
        ];
    }

    /**
     * @return array
     */
    public function getInformationalCodes()
    {
        return [
            [100],
            [101],
            [102],
            [103],
        ];
    }

    /**
     * @return array
     */
    public function getSuccessCodes()
    {
        return [
            [200],
            [201],
            [202],
            [203],
            [204],
            [205],
            [206],
            [207],
            [208],
            [226]
        ];
    }

    /**
     * @return array
     */
    public function getRedirectionCodes()
    {
        return [
            [300],
            [301],
            [302],
            [303],
            [304],
            [305],
            [307],
            [308],
        ];
    }

    /**
     * @return array
     */
    public function getClientErrorCodes()
    {
        return [
            [400],
            [401],
            [402],
            [403],
            [404],
            [405],
            [407],
            [408],
            [451]
        ];
    }

    /**
     * @return array
     */
    public function getServerErrorCodes()
    {
        return [
            [500],
            [501],
            [502],
            [507],
            [510]
        ];
    }

    /**
     * @return Generator
     */
    public function getDefaultStatusMessages()
    {
        $class = new ReflectionClass(NanoHttpStatus::class);
        $statuses = $class->getProperty('defaultStatuses');
        $statuses->setAccessible(true);
        $defaultMessages = $statuses->getValue();

        foreach ($defaultMessages as $code => $message) {
            yield [$code, $message];
        }
    }
}
