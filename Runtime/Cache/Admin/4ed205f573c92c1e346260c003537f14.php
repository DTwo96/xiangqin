<?php if (!defined('THINK_PATH')) exit();?><h3>安全记录</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo U();?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($keyword); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
            </div>
<div class="m-table-mobile"><table id="table" class="m-table "><thead><tr><th>用户</th><th>时间</th><th>IP</th><th>模块</th><th>详情</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
      <td><?php echo ($vo["username"]); ?></td>
      <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
      <td><?php echo ($vo["ip"]); ?></td>
      <td><?php echo ($vo["app"]); ?></td>
      <td> <?php echo ($vo["content"]); ?></td>
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