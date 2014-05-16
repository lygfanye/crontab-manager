<?php
namespace troy\CrontabManager;

/**
 * Created by PhpStorm.
 * User: fanyee
 * Date: 14-5-11
 * Time: 下午5:14
 */

class CrontabFileManager implements CrontabManagerInterface{


	public $fileDir = '/tmp';

	public $fileName = 'crontab';

	private $path = '';

	public function __construct($fileDir='',$fileName=''){

		$fileName = $fileName?$fileName:$this->fileName;
		$filePath = $fileDir?$fileDir:$this->fileDir;
		$this->path = $filePath.DIRECTORY_SEPARATOR.$fileName;

		if(!$this->checkFileDirExist())
			$this->createFileDir();

		if(!$this->checkFileExist()){
			$this->createCrontabFile();
		}
	}

	private  function createCrontabFile(){
		if(!$this->checkFileExist())
			$this->writeToCrontabFile('');
	}

	public function deleteCrontabFile(){
		if($this->checkFileExist())
			unlink($this->path);
	}

	private function writeToCrontabFile($crontabString,$mode=0){
		file_put_contents($this->path,$crontabString,$mode);
	}

	/**
	 * @param $oldCrontab
	 * @param $newCrontab
	 */
	public function update(Crontab $oldCrontab,Crontab $newCrontab){

		$this->remove($oldCrontab);
		$this->append($newCrontab);
	}

	public function append(Crontab $crontab){
		$this->writeToCrontabFile($crontab.PHP_EOL,FILE_APPEND);
	}

	/**
	 * crontab 是正则字符串或者是Crontab对象，用于匹配crontab命令;
	 * 如果是crontab对象对自动用command作为正则对象进行匹配
	 *
	 * @param $crontab
	 * @return bool
	 */
	public function remove($crontab){
		$cronArray = file($this->path);

		if(!$cronArray) return true;
		if(is_arra($crontab)){
			foreach ($crontab as $c){
				if($c instanceof Crontab)
					$c = '#'.$c->command.'$#';
				$cronArray = preg_grep($c,$cronArray,PREG_GREP_INVERT);
			}
		}else{
			if($crontab instanceof Crontab)
				$crontab = '#'.$crontab->command.'$#';
			$cronArray = preg_grep($crontab,$cronArray,PREG_GREP_INVERT);
		}

		$this->writeToCrontabFile(implode("",$cronArray));
	}


	public function checkFileExist(){
		return is_file($this->path)? true : false;
	}

	public function checkFileDirExist(){
		return file_exists($this->fileDir)? true:false;
	}

	private  function createFileDir(){
		if(!mkdir($this->fileDir,0777,true))
			throw new \Exception('FileDir create Fail:'.$this->fileDir);
	}
}
