<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute 是被接受的",
	"active_url"           => ":attribute 必须是一个合法的 URL",
	"after"                => ":attribute 必须是 :date 之后的一个日期",
	"alpha"                => ":attribute 必须全部由字母字符构成",
	"alpha_dash"           => ":attribute 必须全部由字母、数字、中划线或下划线字符构成",
	"alpha_num"            => ":attribute 必须全部由字母和数字构成",
	"array"                => ":attribute 必须是个数组",
	"before"               => ":attribute 必须是 :date 之前的一个日期",
	"between"              => [
		"numeric" => ":attribute 必须在 :min 到 :max 之间",
		"file"    => ":attribute 必须在 :min 到 :max KB 之间",
		"string"  => ":attribute 必须在 :min 到 :max 个字符之间",
		"array"   => ":attribute 必须在 :min 到 :max 项之间",
	],
	"boolean"              => ":attribute 字符必须是 true 或 false",
	"confirmed"            => ":attribute 二次确认不匹配",
	"date"                 => ":attribute 必须是一个合法的日期",
	"date_format"          => ":attribute 与给定的格式 :format 不符合",
	"different"            => ":attribute 必须不同于 :other",
	"digits"               => ":attribute 必须是 :digits 位",
	"digits_between"       => ":attribute 必须在 :min and :max 位之间",
	"email"                => ":attribute 必须是一个合法的电子邮件地址",
	"filled"               => ":attribute 的字段是必填的",
	"exists"               => "选定的 :attribute 是无效的",
	"image"                => ":attribute 必须是一个图片 (jpeg, png, bmp 或者 gif)",
	"in"                   => "选定的 :attribute 是无效的",
	"integer"              => ":attribute 必须是个整数",
	"ip"                   => ":attribute 必须是一个合法的 IP 地址",
	"max"                  => [
		"numeric" => ":attribute 的最大长度为 :max 位",
		"file"    => ":attribute 的最大为 :max KB",
		"string"  => ":attribute 的最大长度为 :max 字符",
		"array"   => ":attribute 的最大个数为 :max个",
	],
	"mimes"                => ":attribute 的文件类型必须是 :values",
	"min"                  => [
		"numeric" => ":attribute 的最小长度为 :min 位",
		"file"    => ":attribute 大小至少为 :min KB",
		"string"  => ":attribute 的最小长度为 :min 字符",
		"array"   => ":attribute 至少有 :min 项",
	],
	"not_in"               => "选定的 :attribute 是无效的",
	"numeric"              => ":attribute 必须是数字",
	"regex"                => ":attribute 格式是无效的",
	"required"             => ":attribute 字段是必须的",
	"required_if"          => ":attribute 字段是必须的 当 :other 是 :value",
	"required_with"        => ":attribute 字段是必须的 当 :values 是存在的",
	"required_with_all"    => ":attribute 字段是必须的 当 :values 是存在的",
	"required_without"     => ":attribute 字段是必须的 当 :values 是不存在的",
	"required_without_all" => ":attribute 字段是必须的 当 没有一个 :values 是存在的",
	"same"                 => ":attribute 和 :other 必须匹配",
	"size"                 => [
		"numeric" => ":attribute 必须是 :size 位",
		"file"    => ":attribute 必须是 :size KB",
		"string"  => ":attribute 必须是 :size 个字符",
		"array"   => ":attribute 必须包括 :size 项",
	],
	"unique"               => ":attribute 已存在",
	"url"                  => ":attribute 无效的格式",
	"timezone"             => ":attribute 必须是个有效的时区",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
		'id' => [
			'required' => '编号不能为空',
			"digits"   => "编号必须是数字",
			"numeric"  => "编号必须是数字",
			"unique"   => "该编号已经存在",
		],
		'password' => [
			'required' => '密码不能为空',
		],
		'phone' => [
			'required' => '手机号不能为空',
			'digits'   => '手机号必须是 11 位数字'
		],
		'email' => [
			'required' => '邮箱不能为空',
			'email' => '邮箱格式不正确'
		],
		'pp_email' => [
			'required' => '邮箱不能为空',
			'email' => '邮箱格式不正确'
		],
		'href' => [
			'required' => '方法名必须填写',
		],
		'btnclass' => [
			'required' => '按钮类必须填写',
		],
		'innerhtml' => [
			'required' => '描述必须填写',
		],
			'user_id' => [
			'unique' => '人员#不可重复',
		],
		'feature_id' => [
			'required' => '操作功能必须填写',
			'unique' => '功能#不可重复',
		],
		'pp_patientid' => [
			'required' => '病历号码必须填写',
			'unique' => '病历号码不可重复',
			'digits'   => '病历号码必须是 18 位数字'
		],
		'pp_personid' => [
			'required' => '身份证号必须填写',
			'unique' => '身份证号不可重复',
			'digits'   => '身份证号必须是 18 位数字'
        ],
		'pp_name' => [
			'required' => '姓名必须填写',
		],
		'pp_height' => [
			'required' => '身高必须填写',
			'numeric' => '身高必须是数字',
			'min' => '身高不能小于 0',
			'max' => '身高不能大于 200',
		],
		'pp_weight' => [
			'required' => '体重必须填写',
			'numeric' => '体重必须是数字',
			'min' => '体重不能小于 0',
			'max' => '体重不能大于 200',
		],
		'account' => [
			'required' => '该身份证号已经存在',
			'alpha_num' => '身份证号必须是英数字',
			'unique' => '该身份证号已经存在',
		]

	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
