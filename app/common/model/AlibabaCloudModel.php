<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Db;
use think\facade\Request;
use think\Model;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

/**
 * @mixin think\Model
 */
class AlibabaCloudModel extends Model
{

    public static $SignName = '海之源';
    public static $AccessKeyId = 'LTAI4Fe74amF4buEA5qMRmfB';
    public static $AccessKeySecret = 't9xhVOsuRAWypBisNjzpLYVcicVH4D';


    public static function sendSms($phone){
        AlibabaCloud::accessKeyClient('LTAI4Fe74amF4buEA5qMRmfB', 't9xhVOsuRAWypBisNjzpLYVcicVH4D')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
        try {
            $code = rand(1000,9999);
            $param = [
                'code' => $code
            ];

            $insertData = [
                'code' => $code,
                'phone' => $phone,
                'ip' => get_client_ip(),
                'send_time' => time(),
                'flag' => 1,
                'type' => 1,
                'isuse' => 0,
                'status' => 1
            ];
            SmsModel::create($insertData);

            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $phone,
                        'SignName' => self::$SignName,
                        'TemplateCode' => "SMS_182666989",
                        'TemplateParam' => json_encode($param),
                    ],
                ])
                ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }

    }
}
