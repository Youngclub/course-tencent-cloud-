<form class="layui-form kg-form" method="POST" action="{{ url({'for':'admin.chapter.create'}) }}">

    <fieldset class="layui-elem-field layui-field-title">
        <legend>添加章节</legend>
    </fieldset>

    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input class="layui-input" type="text" name="title" lay-verify="required">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">简介</label>
        <div class="layui-input-block">
            <textarea class="layui-textarea" name="summary"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="true" lay-filter="go">提交</button>
            <button type="button" class="kg-back layui-btn layui-btn-primary">返回</button>
            <input type="hidden" name="course_id" value="{{ course.id }}">
        </div>
    </div>

</form>