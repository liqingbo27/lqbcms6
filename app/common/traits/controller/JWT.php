<?php
/**
 * Created by PhpStorm.
 * User: 21rock
 * Date: 2018/4/24
 * Time: 上午9:18
 */

namespace app\common\traits\controller;


use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use think\facade\Env;

trait JWT
{
    /**
     * 生成json web token 字符串
     * @param int $userId 用户id
     * @return string $token
     */
    protected function generateJWT($userId)
    {
        $signer = new Sha256();

        return (string)(new Builder())->setIssuer(Env::get('api_site_url'))
            ->setIssuedAt(time())
            ->set('user_id', $userId)
            ->sign($signer, Env::get('jwt_key'))
            ->getToken();
    }

    /**
     * 验证token是否有效
     * @param string $token token字符串aaa.bbb.ccc
     * @return bool
     */
    protected function verifyJWT($token)
    {
        $tokenObj = $this->parseJWT($token);
        $signer = new Sha256();
        return $tokenObj->verify($signer, Env::get('jwt_key'));
    }

    /**
     * 将jwt字符串解析成Token对象
     * @param $token
     * @return \Lcobucci\JWT\Token
     */
    protected function parseJWT($token)
    {
        return (new Parser())->parse((string) $token); // Parses from a string
    }

    /**
     * 从jwt字符串中获取用户ID
     * @param string $token
     * @return mixed
     */
    protected function getUserIdFromJWT($token)
    {
        $tokenObj = $this->parseJWT($token);
        return $tokenObj->getClaim('user_id');
    }
}