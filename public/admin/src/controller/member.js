/**

 @Name：layuiAdmin 内容系统
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：LPPL
    
 */


layui.define(['table', 'form', 'layedit'], function (exports) {
  var $ = layui.$
    , admin = layui.admin
    , view = layui.view
    , table = layui.table
    , layedit = layui.layedit
    , form = layui.form
    , lang = layui.data('lang').lang;

  table.set({
    where: {
      lang: lang
    }
  })

  // console.log('member');

  //文章管理
  table.render({
    elem: '#LAY-app-content-list'
    , url: '/api/member/getList' //模拟接口
    , cols: [[
      { type: 'checkbox', fixed: 'left' }
      , { type: 'numbers', width: 80, title: '序号', align: 'center' }
      , { field: 'name', title: '姓名', minWidth: 120 }
      , { field: 'phone', title: '手机', width: 120 }
      , { field: 'email', title: '邮箱', width: 120 }
      , { field: 'remark', title: '备注', width: 240 }
      , { field: 'create_time', title: '添加时间', sort: true, width: 180 }
      , { title: '操作', minWidth: 150, align: 'center', fixed: 'right', toolbar: '#table-content-list' }
    ]]
    , page: true
    , limit: 20
    , limits: [10, 15, 20, 25, 30]
    , text: '对不起，加载出现异常！'
    , parseData: function (res) { //res 即为原始返回的数据
      return {
        "code": res.code, //解析接口状态
        "msg": res.msg, //解析提示文本
        "count": res.data.total, //解析数据长度
        "data": res.data.data //解析数据列表
      };
    }
  });

  //监听工具条
  table.on('tool(LAY-app-content-list)', function (obj) {
    var data = obj.data;
    if (obj.event === 'del') {
      layer.confirm('确定删除所选数据？', function (index) {
        obj.del();
        layer.close(index);

        admin.req({
          type: "POST",
          url: '/api/member/del',
          data: { ids: data.id },
          dataType: "json",
          success: function (res) {
            layer.msg(res.msg);
          }
        });
        table.reload('LAY-app-content-list');

      });
    } else if (obj.event === 'edit') {
      var h = $(window).height() - 60;
      var w = $(window).width() - 10;
      console.log(h);

      admin.popup({
        title: '编辑'
        , area: ['800px', h + 'px']
        , id: 'LAY-popup-content-edit'
        , success: function (layero, index) {
          view(this.id).render('member/add', data).done(function () {

            form.render(null, 'layuiadmin-app-form-list');
            // console.log(data);

            //监听提交
            form.on('submit(layuiadmin-app-form-submit)', function (data) {
              var field = data.field; //获取提交的字段

              //提交 Ajax 成功后，关闭当前弹层并重载表格
              admin.req({
                type: "POST",
                url: '/api/member/add',
                data: { data: field },
                dataType: "json",
                success: function (res) {
                  layer.msg(res.msg, { time: 800 });
                }
              });

              setTimeout(function () {
                layui.table.reload('LAY-app-content-list'); //重载表格
                layer.close(index); //执行关闭 
              }, 1000);


            });
          });
        }
      });
    }
  });

  exports('member', {})
});