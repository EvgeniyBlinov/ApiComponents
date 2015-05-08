<?php
namespace ApiComponents\Test;

use ApiComponents\ApiResponse;

/**
 * ApiResponse class
 *
 **/
class ApiResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Get data
     *
     * @return array
     **/
    public function getData($isValid = true)
    {
        $validData = array(
            'some' => true
        );

        return $validData;
    }

    /**
     * Get options
     *
     * @param boolean $isValid
     * @return array
     **/
    public function getOptions($isValid = true)
    {
        $validOptions = array(
            'meta' => array(
                'onError' => ''
            ),
            'status' => 300
        );

        return $validOptions;
    }

    /**
     * Test __toString
     *
     * @return void
     **/
    public function testToString()
    {
        $apiResponse = new ApiResponse($this->getData());

        $this->assertEquals(
            '{"status":200,"meta":[],"data":{"some":true}}',
            (string) $apiResponse
        );
    }

    /**
     * Test valid options
     *
     * @return void
     **/
    public function testValidOptions()
    {
        $apiResponse = new ApiResponse($this->getData(), $this->getOptions());
        $this->assertEquals(
            '{"status":300,"meta":{"onError":""},"data":{"some":true}}',
            (string) $apiResponse
        );

    }

    /**
     * Test __toArray
     *
     * @return void
     **/
    public function testToArray()
    {
        $apiResponse = new ApiResponse($this->getData(), $this->getOptions());
        $this->assertEquals(
            array_merge(
                array(
                    'data' => $this->getData()
                ),
                $this->getOptions()
            ),
            $apiResponse->__toArray()
        );
    }
}
