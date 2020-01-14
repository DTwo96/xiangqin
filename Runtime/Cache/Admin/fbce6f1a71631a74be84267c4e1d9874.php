<?php if (!defined('THINK_PATH')) exit();?><h3>签到记录列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo U();?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
            </div>	
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>编号</th><th>用户id</th><th>用户昵称</th><th>最后签到时间</th><th>连续签到天数</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>	
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["uid"]); ?></td>
				<td><?php echo ($niceName[$vo['uid']]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["last_time"])); ?></td>
				<td><?php echo ($vo["continue_days"]); ?></td>
			</tr><?php endforeach; endif; ?></tbody></table></div>
	<div class="m-table-bar">
            <div class="bar-pages">
              <div class="m-page">
                <?php echo ($page); ?>
              </div>
            </div>
            <div class="f-cb"></div>
        </div>
            </div> </div>