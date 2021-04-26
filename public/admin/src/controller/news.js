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
    , url: '/api/news/getList' //模拟接口
    , cols: [[
      { type: 'checkbox', fixed: 'left' }
      , { type: 'numbers', width: 80, title: '序号', align: 'center' }
      , { field: 'title', title: '标题', minWidth: 160 }
      , { field: 'category_name', title: '所属分类', width: 120 }
      , { field: 'lang', title: '语言', width: 120 }
      , { field: 'admin_name', title: '作者', width: 120 }
      , { field: 'status', title: '发布状态', templet: '#buttonTpl', width: 100, align: 'center' }
      , { field: 'create_time', title: '发布时间', sort: true }
      , { field: 'sort', title: '排序', sort: true, width: 80, align: 'center' }
      , { title: '操作', minWidth: 200, align: 'center', fixed: 'right', toolbar: '#table-content-list' }
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
          url: '/api/News/del',
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

      admin.popup({
        title: '编辑'
        , area: ['1000px', h + 'px']
        , id: 'LAY-popup-content-edit'
        , success: function (layero, index) {
          view(this.id).render('news/add', data).done(function () {
            console.log(1);

            layedit.set({
              uploadImage: {
                url: '/api/uploads/edit' //接口url
                , type: 'post' //默认post
              }
            });
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
              var content = ue.getContent();
              field.content = content;

              //提交 Ajax 成功后，关闭当前弹层并重载表格
              admin.req({
                type: "POST",
                url: '/api/News/add',
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
    } else if (obj.event === 'show') {
      window.open("/news/show/id/" + data.id + '/act/view');
    } else if (obj.event === 'toggle') {
      admin.req({
        type: "POST",
        url: '/api/news/changeStatus',
        data: { id: field.admin_id },
        dataType: "json",
        success: function (res) {
          layer.msg(res.msg, { time: 800 });
        }
      });
    }
  });

  //分类管理
  table.render({
    elem: '#LAY-app-content-tags'
    , url: './json/content/tags.js' //模拟接口
    , cols: [[
      { type: 'numbers', fixed: 'left' }
      , { field: 'id', width: 100, title: 'ID', sort: true }
      , { field: 'tags', title: '分类名', minWidth: 100 }
      , { title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#layuiadmin-app-cont-tagsbar' }
    ]]
    , text: '对不起，加载出现异常！'
  });

  exports('news', {})
});