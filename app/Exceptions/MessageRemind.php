<?php
/**
 * Created by LJL.
 * Date: 2022/3/14
 * Time: 16:51
 */

namespace App\Exceptions;


class MessageRemind
{

    //  任务提醒一
    const  TASK_REMIND_ONE = 1;

    //  任务提醒二
    const  TASK_REMIND_TWO = 2;

    // 创建项目推送
    const  TASK_REMIND_THREE = 3;

    // 任务超期推送
    const  TASK_REMIND_FOUR = 4;

    // 任务执行者未操作“提醒此项任务负责人审核”
    const  TASK_REMIND_FIVE = 5;

    // 项目管理者未审核此项任务
    const  TASK_REMIND_SIX = 6;

    // 项目阶段性复盘
    const  TASK_REMIND_SEVEN = 7;

    // 项目进度
    const  TASK_REMIND_EIGHT = 8;

    //消息推送 语言包
    const  WX_REMIND_MSG_TITLE = [
        self::TASK_REMIND_ONE   => "新增任务通知",
        self::TASK_REMIND_TWO   => "任务审核通知",
        self::TASK_REMIND_THREE => "创建项目通知",
        self::TASK_REMIND_FOUR  => "任务超期通知",
        self::TASK_REMIND_FIVE  => "任务执行者未操作",
        self::TASK_REMIND_SIX   => "项目管理者未审核此项任务",
        self::TASK_REMIND_SEVEN   => "项目阶段性复盘通知",
        self::TASK_REMIND_EIGHT   => "项目进度通知",
    ];

    //消息推送 语言包
    const  WX_REMIND_MSG = [
        self::TASK_REMIND_ONE   => "为你发放任务:{task_name}",
        self::TASK_REMIND_TWO   => "请审核任务:{task_name}",
        self::TASK_REMIND_THREE => "添加项目:{pro_name}",
        self::TASK_REMIND_FOUR  => "你好，{user_name},{task_name}超期，如已完成请提醒负责人审核！",
        self::TASK_REMIND_FIVE  => "你好，{user_name},{task_name}超期，如已完成请提醒负责人审核！",
        self::TASK_REMIND_SIX   => "你好，{user_name},{task_name}超期，如已完成请提醒负责人审核！",
        self::TASK_REMIND_SEVEN   => "你好，{user_name},{pro_name}结束，请及时复盘。",
        self::TASK_REMIND_EIGHT   => "你好，{user_name},{pro_name}项目已进行{schedule}，距截止日{day}天。",
    ];
}
