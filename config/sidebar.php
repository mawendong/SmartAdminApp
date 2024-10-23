<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
  'menu' => [[
		'icon' => 'fa fa-tachometer-alt',
		'title' => '主页',
		'url' => '/dashboard',
		'route-name' => 'dashboard'
	],[
		'icon' => 'fa fa-database',
		'title' => '数据管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/database',
			'title' => '数据列表',
			'route-name' => 'database'
		],[
			'url' => '/dashboard/v2',
			'title' => '数据分类',
		]]
	],[
		'icon' => 'fa fa-desktop',
		'title' => '设备管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/dashboard/v1',
			'title' => '设备列表',
		],[
			'url' => '/dashboard/v2',
			'title' => '设备授权',
		]]
	],[
		'icon' => 'fa fa-hdd',
		'title' => '文件管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/email/inbox',
			'title' => '文件管理',
		]]
	],[
		'icon' => 'fa fa-cubes',
		'title' => '插件管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/page-option/page-blank',
			'title' => '插件列表',
		]]
	],[
		'icon' => 'fa fa-gift',
		'title' => '活动福利',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => 'javascript:;',
			'title' => '活动福利',
		]]
	],[
		'icon' => 'fa fa-user',
		'title' => '用户管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => 'javascript:;',
			'title' => '用户列表',
		],[
			'url' => 'javascript:;',
			'title' => '用户添加',
		]]
	],[
		'icon' => 'fa fa-dollar-sign',
		'title' => '支付管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => 'javascript:;',
			'title' => '支付设置'
		],[
			'url' => 'javascript:;',
			'title' => '支付记录'
		]]
	],[
		'icon' => 'fa fa-file-alt',
		'title' => '文章管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/articles',
			'title' => '文章列表',
			'route-name' => 'articles.index'
		],[
			'url' => '/articles/create',
			'title' => '添加文章',
			'route-name' => 'articles.create'
		],[
			'url' => '/articles/1',
			'title' => '查看文章',
			'route-name' => 'articles.show'
		],[
			'url' => '/articles/1/edit',
			'title' => '编辑文章',
			'route-name' => 'articles.edit'
		],[
			'url' => '/articles/softindex',
			'title' => '回收站',
			'route-name' => 'articles.softindex'
		]]
	],[
		'icon' => 'fa fa-question-circle',
		'title' => '帮助中心',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/helper',
			'title' => '帮助文档',
			'route-name' => 'help'
		]]
	],[
		'icon' => 'fa fa-user-circle',
		'title' => '个人中心',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/user/profile',
			'title' => '更改信息',
			'route-name' => 'user.profile.edit'
		],[
			'url' => '/user/avatar',
			'title' => '更改头像',
			'route-name' => 'user.avatar.edit'
		],[
			'url' => '/user/loginlog',
			'title' => '登录日志',
			'route-name' => 'user.loginlog.index'
		]]
	],[
		'icon' => 'fa fa-cog',
		'title' => '系统管理',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/helper/css',
			'title' => '系统设置'
		],[
			'url' => '/nav/create',
			'title' => '导航设置',
			'route-name' => 'user.index'
		],[
			'url' => '/nav/create',
			'title' => '权限设置',
			'route-name' => 'user.index'
		],[
			'url' => '/nav/create',
			'title' => '用户组设置',
			'route-name' => 'user.index'
		],[
			'url' => 'javascript:;',
			'title' => '邮件设置',
			'route-name' => 'email.index'
		],[
			'url' => 'javascript:;',
			'title' => '重置缓存',
			'route-name' => 'cache.index'
		],[
			'url' => 'javascript:;',
			'title' => '属性分类',
			'sub_menu' => [[
				'url' => '/types',
				'title' => '分类列表',
				'route-name' => 'types.index'
			],[
				'url' => '/types/create',
				'title' => '添加分类',
				'route-name' => 'types.create'
			],[
				'url' => '/types/1',
				'title' => '查看分类',
				'route-name' => 'types.show'
			],[
				'url' => '/types/1/edit',
				'title' => '编辑分类',
				'route-name' => 'types.edit'
			]]
		]]
	]]
];
