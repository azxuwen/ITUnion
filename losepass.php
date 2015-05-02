<!--创建者 : 徐文志 创建时间 : 2014 01 17    21:57  站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:处理用户忘记密码 -->
<!--引入页头文件start-->
<?php
include 'header.php';
include 'Include/config.inc.php';
require_once 'Include/ComFunction.php';
?>
<!--引入页头文件end-->
<!--  这里显示页面内容  start-->
<div id='center_width_70'>
<?php
/*修改密码步骤
 * 1 : 先要有一个输入框，输入邮箱
 * 2 ： 生成一个随机验证码，并发送给用户
 * 3 ： 然后用户回到该页面输入那个验证码，然后执行修改密码
 */
//这里生成一个随机验证码 然后放在一个隐藏表单里面
echo "<input type='hidden' id='lp_hid_code' value='".getRandomCode(6)."'/> ";
?>
<form id="msform">
	<!-- fieldsets -->
	<fieldset id="lp_field_1">
		<h2 class="fs-title">输入您注册本站时使用的邮件地址</h2>
		<h3 class="fs-subtitle">1/3</h3>
		<input type="email" id="lp_email" name="lp_email" required placeholder="填写您的电子邮件地址" />
		<span class="lp_email_infor"></span><br/>
		<input type="button" id="lp_next1" class="next action-button" value="下一步" />
	</fieldset>
	<fieldset id="lp_field_2">
		<h2 class="fs-title">我们已将验证码发送到您的邮箱</h2>
		<h3 class="fs-subtitle">2/3</h3>
		<input type="text" id="verifycode" name="verifycode" placeholder="输入验证码" />
		<span class="lp_code_infor"></span><br/>
		<input type="button" id="lp_next2" name="lp_next2" class="next action-button" value="下一步" />
	</fieldset>
	<fieldset id="lp_field_3">
		<h2 class="fs-title">修改密码</h2>
		<h3 class="fs-subtitle">3/3</h3>
		<input type="password" id="lp_pass1" name="lp_pass1" placeholder="输入新密码" /><br/>
		<input type="password" id="lp_pass2" name="lp_pass2" placeholder="输入新密码" />
		<span class="lp_pass_infor"></span><br/>
		<input type="button" id="lp_next3" name="lp_next3" class="submit action-button" value="修改!" />
	</fieldset>
	<fieldset id="lp_ok">
		<h2 class="fs-title">修改结果</h2>
		<br/>
		<h3><font color='black' size='4'>恭喜您，成功修改了密码，点击<a href='Login.php'><font color='black' size='4'>登录</font></a></font></h3>
	</fieldset>
	<fieldset id="lp_no">
		<h2 class="fs-title">修改结果</h2>
		<br/>
		<h3><font color='black' size='4'>抱歉，修改失败，您可以刷新页面从新修改</font></h3>
	</fieldset>
</form>
</div><!-- center_width_70 -->
<!--  这里显示页面内容  end-->
<!--引入页尾文件start-->
<?php
	include 'footer.php';
?>
<!--引入页尾文件end-->
</body>
</html>
