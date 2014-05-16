crontab-manager
===============



usage:


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