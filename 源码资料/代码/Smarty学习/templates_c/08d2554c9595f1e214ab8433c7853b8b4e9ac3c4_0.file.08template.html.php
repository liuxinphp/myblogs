<?php
/* Smarty version 3.1.32, created on 2018-09-20 00:53:09
  from 'D:\server\Web\08template.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ba27ef5481cb1_99640434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08d2554c9595f1e214ab8433c7853b8b4e9ac3c4' => 
    array (
      0 => 'D:\\server\\Web\\08template.html',
      1 => 1537375980,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ba27ef5481cb1_99640434 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	

	<?php if (isset($_POST['username'])) {?>
		<?php echo $_POST['username'];?>

	<?php } else { ?>
		没有数据
	<?php }?>

		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
$__foreach_v_0_saved = $_smarty_tpl->tpl_vars['v'];
?>
		<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['v']->key;?>
:<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
<br/>
	<?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

	<?php $_smarty_tpl->_assignInScope('user1', array('username','age','gender'));?>
        <table border=1>
           <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user1']->value, 'value', true);
$_smarty_tpl->tpl_vars['value']->show = ($_smarty_tpl->tpl_vars['value']->total > 0);
$_smarty_tpl->tpl_vars['value']->iteration = 0;
$_smarty_tpl->tpl_vars['value']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->iteration++;
$_smarty_tpl->tpl_vars['value']->index++;
$_smarty_tpl->tpl_vars['value']->first = !$_smarty_tpl->tpl_vars['value']->index;
$__foreach_value_1_saved = $_smarty_tpl->tpl_vars['value'];
?>
        	<?php if ($_smarty_tpl->tpl_vars['value']->first) {?> 第一次执行循环：
                <tr>
                    <th>下标</th>
                    <th>循环次数</th>
                    <th>值</th>
                </tr>
        	<?php }?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['value']->index;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['value']->iteration;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</td>
            </tr>
        <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
        </table>
        <?php if ($_smarty_tpl->tpl_vars['value']->show) {?> 循环有数据，一共循环了<?php echo $_smarty_tpl->tpl_vars['value']->total;?>
次<?php }?>


        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arr']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
        	<?php echo $_smarty_tpl->tpl_vars['val']->value;?>

        <?php
}
} else {
?>
        	没有数据o(╥﹏╥)o
       	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


    <?php $_smarty_tpl->_assignInScope('arr', array(1,2,3,4,5,6));?>
    <?php
$__section_id_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arr']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_id_0_total = min(($__section_id_0_loop - 0), 4);
$_smarty_tpl->tpl_vars['__smarty_section_id'] = new Smarty_Variable(array());
if ($__section_id_0_total !== 0) {
for ($__section_id_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] = 0; $__section_id_0_iteration <= $__section_id_0_total; $__section_id_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']++){
?>
        <?php echo $_smarty_tpl->tpl_vars['arr']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)];?>
										
    <?php
}
}
?>


    <div>
            <a href="javascript:show()">点我</a>
    </div>
        
        <?php echo '<script'; ?>
>
            function show(){
                alert('hello world');
            }
        <?php echo '</script'; ?>
>
        
</body>
</html><?php }
}
