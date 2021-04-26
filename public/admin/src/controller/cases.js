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
  //文章管理
  table.render({
    elem: '#LAY-app-content-list'
    , url: '/api/cases/getList' //模拟接口
    , cols: [[
      { type: 'checkbox', fixed: 'left' }
      , { type: 'numbers', width: 80, title: '序号', align: 'center' }
      , { field: 'title', title: '标题', minWidth: 160 }
      // ,{field: 'category_name', title: '所属分类', width: 120}
      , { field: 'thumb', title: '缩略图', width: 120, templet: '<div><img src="{{ d.thumb }}" ></div>' }
      , { field: 'admin_name', title: '作者', width: 120 }
      , { field: 'status', title: '发布状态', templet: '#buttonTpl', width: 100, align: 'center' }
      , { field: 'create_time', title: '发布时间', sort: true }
      , { title: '操作', minWidth: 150, align: 'center', fixed: 'right', toolbar: '#table-content-list' }
    ]]
    , page: true
    , limit: 10
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
          url: '/api/cases/del',
          data: { ids: data.id },
          dataType: "json",
          success: function (res) {
            layer.msg(res.msg);
            layui.table.reload('LAY-app-content-list'); //重载表格
          }
        });
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
          view(this.id).render('cases/add', data).done(function () {

            layedit.set({
              uploadImage: {
                url: '/api/uploads/edit' //接口url
                , type: 'post' //默认post
              }
            });

            // $("#content").val(data.content); //先赋值
            // var editIndex = layedit.build('content'); //建立编辑器
            ue.ready(function () {
              ue.setContent(data.content);
            });

            form.render(null, 'layuiadmin-app-form-list');
            // console.log(data);

            //监听提交
            form.on('submit(layuiadmin-app-form-submit)', function (data) {
              var field = data.field; //获取提交的字段
              if (field.status == 'on') {
                field.status = 1;
              } else {
                field.status = 0;
              }
              // var content = layedit.getContent(editIndex);
              // field.content = content;
              var content = ue.getContent();
              field.content = content;

              //提交 Ajax 成功后，关闭当前弹层并重载表格
              admin.req({
                type: "POST",
                url: '/api/cases/add',
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





  exports('cases', {})
});