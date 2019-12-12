<form class="layui-form kg-form" method="POST" action="{{ url({'for':'admin.config.mailer'}) }}">

    <fieldset class="layui-elem-field layui-field-title">
        <legend>邮件配置</legend>
    </fieldset>

    <div class="layui-form-item">
        <label class="layui-form-label">发送邮箱</label>
        <div class="layui-input-block">
            <input class="layui-input" type="text" name="smtp_from_email" value="{{ mailer.smtp_from_email }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">发送人</label>
        <div class="layui-input-block">
            <input class="layui-input" type="text" name="smtp_from_name" value="{{ mailer.smtp_from_name }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">SMTP服务器</label>
        <div class="layui-input-block">
            <input class="layui-input" type="text" name="smtp_host" value="{{ mailer.smtp_host }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">SMTP端口号</label>
        <div class="layui-input-block">
            <input class="layui-input" type="text" name="smtp_port" value="{{ mailer.smtp_port }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">加密类型</label>
        <div class="layui-input-block">
            <input type="radio" name="smtp_encryption" value="ssl" title="SSL" {% if mailer.smtp_encryption == "ssl" %}checked{% endif %}>
            <input type="radio" name="smtp_encryption" value="tls" title="TLS" {% if mailer.smtp_encryption == "tls" %}checked{% endif %}>
            <input type="radio" name="smtp_encryption" value="" title="不加密" {% if mailer.smtp_encryption == "" %}checked{% endif %}>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">账户验证</label>
        <div class="layui-input-block">
            <input type="radio" name="smtp_authentication" value="1" title="是" lay-filter="smtp-auth" {% if mailer.smtp_authentication == "1" %}checked{% endif %}>
            <input type="radio" name="smtp_authentication" value="0" title="否" lay-filter="smtp-auth" {% if mailer.smtp_authentication == "0" %}checked{% endif %}>
        </div>
    </div>

    <div id="smtp-auth-block">
        <div class="layui-form-item">
            <label class="layui-form-label">SMTP帐号</label>
            <div class="layui-input-block">
                <input class="layui-input" type="text" name="smtp_username" value="{{ mailer.smtp_username }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">SMTP密码</label>
            <div class="layui-input-block">
                <input class="layui-input" type="text" name="smtp_password" value="{{ mailer.smtp_password }}">
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="true" lay-filter="go">提交</button>
            <button type="button" class="kg-back layui-btn layui-btn-primary">返回</button>
        </div>
    </div>

</form>

<form class="layui-form kg-form" method="POST" action="{{ url({'for':'admin.test.mailer'}) }}">

    <fieldset class="layui-elem-field layui-field-title">
        <legend>邮件测试</legend>
    </fieldset>

    <div class="layui-form-item">
        <label class="layui-form-label">收件邮箱</label>
        <div class="layui-input-block">
            <input class="layui-input" type="text" name="email" lay-verify="email" placeholder="请先提交相关配置，再进行邮件测试哦！">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="true" lay-filter="go">提交</button>
            <button type="button" class="kg-back layui-btn layui-btn-primary">返回</button>
        </div>
    </div>

</form>

<script>

    layui.use(['jquery', 'form'], function () {

        var $ = layui.jquery;
        var form = layui.form;

        form.on('radio(smtp-auth)', function (data) {
            var block = $('#smtp-auth-block');
            if (data.value == 1) {
                block.show();
            } else {
                block.hide();
            }
        });

    });

</script>