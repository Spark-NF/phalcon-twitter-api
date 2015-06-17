<?php
require_once "../app/library/twitteroauth/autoload.php";

class ApiController extends ControllerBase
{
    public function indexAction()
    {
        header('Content-Type: application/json');

        // We need a token
        if (!isset($_GET['token'])) {
            exit(json_encode(array('code' => 1, 'message' => 'Missing token')));
        }

        // Check token and get user ID
        $token = $_GET['token'];
        $user = Users::findFirst(array('token = :token:', 'bind' => array('token' => $token)));
        if (empty($user)) {
            exit(json_encode(array('code' => 2, 'message' => 'Wrong token')));
        }

        // $_GET parameters to pass to the API
        $url = $this->dispatcher->getParam('url');
        $data = $_GET;
        unset($data['_url']);
        unset($data['token']);

        // Count call in database
        $history = new History();
        $history->getReadConnection()->query('INSERT INTO history VALUES (:id, NOW(), 1) ON DUPLICATE KEY UPDATE calls = calls + 1', array('id' => $user->id));

        // Get cache key from URL
        $cache = $this->di->getShared('cacheShort');
        $cacheKey = $url;
        if ($data)
            $cacheKey = sprintf("%s?%s", $cacheKey, http_build_query($data));
        $cacheKey = md5($cacheKey);

        // Call twitter API if not already in cache
        $response = $cache->get($cacheKey);
        if ($response === null) {
            $connection = new TwitterOAuth\TwitterOAuth('KGqlnCFh9OcEygohNCmgBktZi', 'O5vmL3bwbIVe6YNjHthWt1eGmwaLsUnSclHZK2lkCWHiBif0ka', '', '');
            $response = json_encode($connection->get($url, $data));
            $cache->save($cacheKey, $response);
        }

        exit($response);
    }
}
