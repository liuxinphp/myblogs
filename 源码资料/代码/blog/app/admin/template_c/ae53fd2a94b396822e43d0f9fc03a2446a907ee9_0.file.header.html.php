<?php
/* Smarty version 3.1.32, created on 2018-11-01 22:41:55
  from 'D:\blog\app\admin\view\Public\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bdb10b3e22294_81218745',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae53fd2a94b396822e43d0f9fc03a2446a907ee9' => 
    array (
      0 => 'D:\\blog\\app\\admin\\view\\Public\\header.html',
      1 => 1540985045,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bdb10b3e22294_81218745 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="header">
    	<!-- logo -->
    	<div class="logo">	<a href="#"><span class="logo-text text-center font18">博客后台</span></a>	</div>

        <!-- notifications -->
        <div id="notifications">
          <div class="clear"></div>
        </div>

        <!-- quick menu -->
        <div id="quickmenu">
            <a href="#" class="qbutton-left tips" title="新增一篇博客"><img src="<?php echo P;?>
/img/icons/header/newpost.png" width="18" height="14" alt="new post" /></a>
            <a href="#" class="qbutton-right tips" title="直达前台"><img src="<?php echo P;?>
/img/icons/sidemenu/magnify.png" width="18" height="14" alt="new post" /></a>
            <div class="clear"></div>
        </div>

        <!-- profile box -->
        <div id="profilebox">
        	<a href="#" class="display">
            	<img src="<?php echo P;?>
/img/simple-profile-img.jpg" width="33" height="33" alt="profile"/> <span><?php if ($_SESSION['user']['u_is_admin']) {?>管理员<?php } else { ?>用户<?php }?></span> <b>昵称：<?php echo $_SESSION['user']['u_username'];?>
</b>
            </a>

            <div class="profilemenu">
            	<ul>
                	<li><a href="<?php echo URL;?>
index.php?p=admin&c=privilege&a=logout">退出</a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div><?php }
}
