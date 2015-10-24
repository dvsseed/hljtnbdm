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

	"accepted"             => "The :attribute must be accepted.",
	"active_url"           => "The :attribute is not a valid URL.",
	"after"                => "The :attribute must be a date after :date.",
	"alpha"                => "The :attribute may only contain letters.",
	"alpha_dash"           => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The :attribute may only contain letters and numbers.",
	"array"                => "The :attribute must be an array.",
	"before"               => "The :attribute must be a date before :date.",
	"between"              => [
		"numeric" => "The :attribute must be between :min and :max.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => "The :attribute must be between :min and :max characters.",
		"array"   => "The :attribute must have between :min and :max items.",
	],
	"boolean"              => "The :attribute field must be true or false.",
	"confirmed"            => "The :attribute confirmation does not match.",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	//"digits_between"       => "The :attribute must be between :min and :max digits.",
	"digits_between"       => "分数在0-100之间",
	"email"                => "The :attribute must be a valid email address.",
	"filled"               => "The :attribute field is required.",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "The :attribute must be an integer.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => [
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "The :attribute may not be greater than :max characters.",
		"array"   => "The :attribute may not have more than :max items.",
	],
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => [
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	],
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "The :attribute field is required.",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => [
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	],
	"unique"               => "The :attribute has already been taken.",
	"url"                  => "The :attribute format is invalid.",
	"timezone"             => "The :attribute must be a valid zone.",

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
                        'unique' => '人员编号不可重复',
                ],
                'feature_id' => [
                       	'required' => '操作功能必须填写',
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
