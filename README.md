crontab-manager
===============


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require troy/crontab-manager "*"
```

or add

```
"troy/crontab-manager": "*"
```

to the require section of your `composer.json` file.


usage:
------------
1.simple example:
```
	use troy\CrontabManager\Crontab;

	$crontab = new Crontab(array(
	 'command'=>'command script',
	 .....
	));

	$cm = new troy\CrontabManager\CrontabFileManager('');

	$cm->append($crontab);
	$cm->remove($crontab);

	$newCrontab = new Crontab(array(
	 'command'=>'command script 2'
	));

	$cm->update($crontab,$newCrontab);

```
