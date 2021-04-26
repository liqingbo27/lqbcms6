<?php
declare (strict_types = 1);

namespace app\middleware;
use app\common\traits\controller\JWT;
use think\facade\Cache;
use think\facade\Session;

class Auth
{
    use JWT;

    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //$header = $request->header();
        //$header = request()->header();

        $admin_id = Session::get('admin_id');
        //throw new \think\exception\HttpException(0, '异常消息222');

        //abort(0, $admin_id);

        // 1.先从header取出token字符串
        /*if (isset($header['token'])) {

            if($header['token']=='test'){
                return $next($request);
            }

            $tokenString = (string)$header['token'];
            if (empty($tokenString)) {
                exception("token值为空", 100001);
            }

            // 2.验证token是否合法
            if ($this->verifyJWT($tokenString)) {
                // 3.将token字符串转换成Token对象然后取出user_id
                $userId = $this->getUserIdFromJWT($tokenString);
                $userInfo = model('user')
                    ->where('user_id', 'eq', $userId)
                    ->where('delete_flag', 'eq', User::UN_DELETE)
                    //->where('user_type', 'eq', User::USER_TYPE_STAFF)
                    ->find();
                if (!$userInfo) {
                    exception('用户不存在或已删除', 100001);
                }
                // 单点登录
                // 4.在redis里查找token查找数据，如果查不到则返回token不存在
                $token = Cache::store('redis')->get('user_id:' . $userId);
                if (empty($token) || ($tokenString != $token)) {
                    exception('用户未登录,请先登录', 100001);
                }
            } else {
                exception('非法token', 100001);
            }
        } else {
            exception('请求头缺少token参数', 100001);
        }*/
        return $next($request);
    }
}
