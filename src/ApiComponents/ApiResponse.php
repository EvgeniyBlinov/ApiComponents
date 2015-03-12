<?php
namespace ApiComponents;

/**
 * ApiResponse class
 *
 **/
class ApiResponse
{
    /**
     * @var array of data
     **/
    public $data   = array();

    /**
     * @var array of meta data
     **/
    public $meta   = array();

    /**
     *@var integer of response status
     **/
    public $status = 200;

    /**
     * Constructor
     *
     * @param mixed $response
     **/
    function __construct($data, array $options = array())
    {
        $this->data = (array) $data;
        $this->setOptions($options);
    }

    /**
     * Set options
     *
     * @param array $options
     * @return ApiResponse
     **/
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (property_exists(get_class($this), $key)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    /**
     * Convert response to array
     *
     * @return array
     **/
    public function __toArray()
    {
        echo "ok";die;
        
        return array(
            'status' => $this->status,
            'meta'   => $this->meta,
            'data'   => $this->data,
        );
    }

    /**
     * Convert response to string
     *
     * @return string
     **/
    public function __toString()
    {
        return json_encode($this->__toArray());
    }
}
