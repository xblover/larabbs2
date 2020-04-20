<?php
/**
 * Created by PhpStorm
 * User: xubo
 * Date: 2020/4/12
 * Time: 14:45
 * Email: xubo1395015060@qq.com
 */

namespace App\Common\Auth;


use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use function GuzzleHttp\Psr7\str;

/**
 * 单例 一次请求中所有出现使用jwt的地方都是一个用户
 * Class JwtAuth
 * @package App\Common\Auth
 */
class JwtAuth
{
    /**
     * jwt token
     * @var
     */
    private $token;



    /**
     * claim iss
     * @var string
     */
    private $iss = 'local.larabbs.test';

    /**
     * claim aud
     * @var string
     */
    private $aud = 'larabbs';

    /**
     * claim uid
     * @var
     */
    private $uid;

    /**
     * secret
     * @var string
     */
    private $secret = '%^*(&*)^&$^#%$^&**)(**&*&';

    /**
     * decode token
     * @var
     */
    private $decodeToken;

    /**
     * 单例模式 jwtAuth 句柄
     * @var
     */
    private static $instance;

    /**
     * 获取jwtAuth 句柄
     * @return JwtAuth
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 私有化构造函数
     * JwtAuth constructor.
     */
    private function __construct()
    {
    }

    /**
     * 私有化clone函数
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * 获取token
     * @return string
     */
    public function getToken()
    {
        return (string)$this->token;
    }

    /**
     * 设置token
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * uid
     * @param $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * get uid
     * @return mixed
     */
    public function getUid()
    {
        return (int)$this->uid;
    }

    /**
     * 编码jwt token
     * @return $this
     */
    public function encode()
    {
        $time = time();
        $this->token = (new Builder())->setHeader('alg', 'HS256')
            ->setIssuer($this->iss)
            ->setAudience($this->aud)
            ->setIssuedAt($time)
            ->setExpiration($time + 3600)
            ->set('uid', $this->uid)
            ->sign(new Sha256(), $this->secret)
            ->getToken();

        return $this;
    }

    /**
     * decode
     * @return \Lcobucci\JWT\Token
     */
    public function decode()
    {
        if (!$this->decodeToken){
            $this->decodeToken = (new Parser())->parse((string)$this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }

        return $this->decodeToken;
    }

    /**
     * verify
     */
    public function verify()
    {
        return $this->decode()->verify(new Sha256(),$this->secret);
    }

    /**
     * validate
     * @return bool
     */
    public function validate()
    {
        $data = new ValidationData();
        $data->setIssuer($this->iss);
        $data->setAudience($this->aud);

        return $this->decode()->validate($data);
    }







}
