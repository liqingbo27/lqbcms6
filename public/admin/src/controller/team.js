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

  // console.log('team');

  //文章管理
  table.render({
    elem: '#LAY-app-content-list'
    , url: '/api/team/getList' //模拟接口
    , cols: [[
      { type: 'checkbox', fixed: 'left' }
      , { type: 'numbers', width: 80, title: '序号', align: 'center' }
      , { title: '所属分类', width: 120, align: 'center', toolbar: '#category_id' }
      , { field: 'title', title: '姓名', width: 120, align: 'center' }
      , { title: '头像', width: 120, toolbar: '#thumb', align: 'center' }
      , { field: 'position', title: '职位', width: 120, align: 'center' }
      , { field: 'description', title: '简介', minWidth: 140, align: 'center' }
      , { field: 'status', title: '状态', templet: '#buttonTpl', width: 100, align: 'center' }
      , { field: 'update_time', title: '更新时间', sort: true, width: 160, align: 'center' }
      , { field: 'sort', title: '排序', sort: true, width: 80, align: 'center' }
      , { title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-content-list' }
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
          url: '/api/team/del',
          data: { ids: data.id },
          dataType: "json",
          success: function (res) {
            layer.msg(res.msg);
            layui.table.reload('LAY-app-content-list'); //重载表格
          }
        });

      });
    } else if (obj.event === 'edit') {

      admin.popup({
        title: '编辑'
        , area: ['900px', '900px']
        , id: 'LAY-popup-content-edit'
        , success: function (layero, index) {
          view(this.id).render('team/add', data).done(function () {

            ue.ready(function () {
              ue.setContent(data.content);
            });

            form.render(null, 'layuiadmin-app-form-list');
            // console.log(data);

            //监听提交
            form.on('submit(layuiadmin-app-form-submit)', function (data) {
              var field = data.field; //获取提交的字段

              var content = ue.getContent();
              field.content = content;

              //提交 Ajax 成功后，关闭当前弹层并重载表格
              admin.req({
                type: "POST",
                url: '/api/team/add',
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

  //监听搜索
  form.on('submit(LAY-app-contlist-search)', function (data) {
    var field = data.field;

    //执行重载
    table.reload('LAY-app-content-list', {
      where: field
    });
  });

  var active = {
    batchdel: function () {
      var checkStatus = table.checkStatus('LAY-app-content-list')
        , checkData = checkStatus.data; //得到选中的数据

      if (checkData.length === 0) {
        return layer.msg('请选择数据');
      }

      var ids = [];   //声明数组
      for (var i = 0; i < checkData.length; i++) {
        ids.push(checkData[i].id);
      }


      layer.confirm('确定要删除所选数据?', function (index) {
        // console.log(ids);
        admin.req({
          type: "POST",
          url: '/api/team/del',
          data: { ids: ids },
          dataType: "json",
          success: function (res) {
            layer.msg(res.msg);
            table.reload('LAY-app-content-list');
          }
        });

      });

    }

    //添加
    , add: function (othis) {
      admin.popup({
        title: '添加文章'
        , area: ['1000px', '800px']
        , id: 'LAY-popup-content-add'
        , success: function (layero, index) {
          view(this.id).render('/team/add').done(function () {
            form.render(null, 'layuiadmin-app-form-list');

            //监听提交
            form.on('submit(layuiadmin-app-form-submit)', function (data) {
              var field = data.field; //获取提交的字段
              field.lang = lang

              var content = ue.getContent();
              field.content = content;

              //提交 Ajax 成功后，关闭当前弹层并重载表格
              admin.req({
                type: "POST",
                url: '/api/team/add',
                data: { data: field },
                dataType: "json",
                success: function (res) {
                  layer.msg(res.msg, { time: 800 });

                  layui.table.reload('LAY-app-content-list'); //重载表格
                  layer.close(index); //执行关闭
                }
              });
            });
          });
        }
      });
    }
  };

  $('.layui-btn.layuiadmin-btn-list').on('click', function () {
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });

  exports('team', {})
});