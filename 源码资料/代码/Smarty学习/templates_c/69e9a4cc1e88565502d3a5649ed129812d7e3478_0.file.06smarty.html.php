<?php
/* Smarty version 3.1.32, created on 2018-09-20 00:32:41
  from 'D:\server\Web\06smarty.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ba27a297e84f5_06361010',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69e9a4cc1e88565502d3a5649ed129812d7e3478' => 
    array (
      0 => 'D:\\server\\Web\\06smarty.html',
      1 => 1537374759,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ba27a297e84f5_06361010 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<header></header>
	<?php
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, 'smarty_config/config.txt', null, 0);
?>

	<?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'bgcolor');?>

</body>
<body bgcolor="<?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'bgcolor');?>
">
	<?php echo $_smarty_tpl->tpl_vars['str']->value;?>



		<?php echo $_smarty_tpl->tpl_vars['arr']->value[0];?>
 ------ <?php echo $_smarty_tpl->tpl_vars['arr']->value[0];?>



		<?php echo $_smarty_tpl->tpl_vars['obj']->value->name;?>
 ----- <?php echo $_smarty_tpl->tpl_vars['obj']->value->age;?>


		<?php echo $_GET['username'];?>

	<?php echo dirname($_smarty_tpl->source->filepath);?>

	<?php echo basename($_smarty_tpl->source->filepath);?>



		<?php $_smarty_tpl->_assignInScope('test', 'hey world');?>
	<?php echo $_smarty_tpl->tpl_vars['test']->value;?>


	<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'pTitle');?>

	
</html><?php }
}
