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
            (array) $apiResponse
        );
    }

    /**
     * @var array of data
     **/
    //public $data   = array();

    /**
     * @var array of meta data
     **/
    //public $meta   = array();

    /**
     *@var integer of response status
     **/
    //public $status = 200;

    /**
     * Constructor
     *
     * @param mixed $response
     **/
    //function __construct($data, array $options = array())
    //{
        //$this->data = (array) $data;
        //$this->setOptions($options);
    //}

    /**
     * Set options
     *
     * @param array $options
     * @return ApiResponse
     **/
    //public function setOptions(array $options)
    //{
        //foreach ($options as $key => $value) {
            //if (property_exists(get_class($this), $key)) {
                //$this->$key = $value;
            //}
        //}

        //return $this;
    //}

    /**
     * Convert response to array
     *
     * @return array
     **/
    //public function __toArray()
    //{
        //return array(
            //'status' => $this->status,
            //'meta'   => $this->meta,
            //'data'   => $this->data,
        //);
    //}

    /**
     * Convert response to string
     *
     * @return string
     **/
    //public function __toString()
    //{
        //return json_encode($this->__toArray());
    //}
}
