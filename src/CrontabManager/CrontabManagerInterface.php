<?php
namespace troy\CrontabManager;
/**
 * Created by PhpStorm.
 * User: fanyee
 * Date: 14-5-11
 * Time: 下午4:39
 */

interface CrontabManagerInterface {

	public function append(Crontab $crontab);

	public function remove($crontab);

	public function update(Crontab $oldCrontab,Crontab $newCrontab);
}