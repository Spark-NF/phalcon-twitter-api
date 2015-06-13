<?php
class ApiController extends ControllerBase
{
    protected function callAPI($method, $url, $data = false)
    {
        $curl = curl_init();
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;

            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;

            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        /*curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");*/
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function indexAction()
    {
        if (!isset($_GET['token'])) {
            exit(json_encode(array('code' => 1, 'message' => 'Missing token')));
        }

        $token = $_GET['token'];
        // TODO check token

        $url = $this->dispatcher->getParam('url');

        $data = $_GET;
        unset($data['_url']);
        unset($data['token']);

        $cache = $this->di->getShared('cacheShort');
        $cacheKey = $url;
        if ($data)
            $cacheKey = sprintf("%s?%s", $cacheKey, http_build_query($data));
        $cacheKey = md5($cacheKey);

        $response = $cache->get($cacheKey);
        if ($response === null) {
            $response = $this->callAPI('GET', 'https://api.twitter.com/'.$url, $data);
            $cache->save($cacheKey, $response);
        }

        exit($response);
    }
}
