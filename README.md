[![MIT License][license-image]][license-url]

# ApiComponents
Simple API components.

## Usage

Yii2 example with simple API action.

Set API error and response type to custom json:

```php
    /**
     * Init
     *
     * @return void
     **/
    public function init()
    {
        if (defined('YII_ENV') && YII_ENV == 'prod') { 
            $handler = new ApiErrorHandler();
            \Yii::$app->set('errorHandler', $handler);
            $handler->register();
        }
        \Yii::$app->response->format = 'json';
        parent::init();
    }
```
Create any version action:

```php
    /**
     * Action for version 1
     *
     * @param string $arguments
     * @return array
     **/
    public function actionV1($arguments)
    {
        $meta = [
            'server_name' => $_SERVER['SERVER_NAME'],
        ];
        // get production API if Development environvent enable
        if (defined('YII_ENV') && YII_ENV == 'dev_api') { 
            $content = @file_get_contents(
                'http://main-site-host' . 
                \Yii::$app->request->url
            );
            if ($result = json_decode($content, true)) {
                return $result;
            }
        }

        $apiArgv = explode('/', $arguments);
        $params  = array_diff_key(Yii::$app->request->get(), array_flip(array('arguments')));
        if ($apiArgv[0] == 'doc') {
            return $this->renderDoc();
        }
        if (!empty($apiArgv[1])) {
            $params['id'] = $apiArgv[1];
        }
        return (new ApiResponse(
            $this->getAllModelData($apiArgv[0], $params),
            compact('meta')
        ))->__toArray();
    }
```
## License

[![MIT License][license-image]][license-url]

## Author

- [Blinov Evgeniy](mailto:evgeniy_blinov@mail.ru) ([http://blinov.in.ua/](http://blinov.in.ua/))

[license-image]: http://img.shields.io/badge/license-MIT-blue.svg?style=flat
[license-url]: LICENSE


