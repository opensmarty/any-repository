<?php
namespace Iwanli\Repository\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class CriteriaCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'any:criteria {name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Criteria';

    protected $type = 'Criteria';

    /**
     * 实现抽象类 getStub 方法
     * @author 晚黎
     * @date   2017-11-06
     * @return [type]     [description]
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/Criteria.stub';
    }
    /**
     * 重写根命名空间
     * @author 晚黎
     * @date   2017-11-06
     * @return [type]     [description]
     */
    protected function rootNamespace()
    {
        return $this->laravel->getNamespace().$this->getCriteriaNamespace();
    }
    /**
     * 重写文件路径方法
     * @author 晚黎
     * @date   2017-11-06
     * @param  [type]     $name [description]
     * @return [type]           [description]
     */
    protected function getPath($name)
    {
        $name = str_replace_first($this->rootNamespace(), '', $this->getCriteriaNamespace().$name);
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Criteria.php';
    }
    

    /**
     * 创建文件
     * @author 晚黎
     * @date   2017-11-06
     * @param  [type]     $name [description]
     * @return [type]           [description]
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['DummyNamespace', 'DummyClass'],
            [$this->getNamespace($name), $class],
            $stub);

    }
    
    /**
     * 获取 Criteria 目录名称
     * @author 晚黎
     * @date   2017-11-06
     * @return [type]     [description]
     */
    public function getCriteriaNamespace()
    {
        return str_replace('/', '\\', config('repository.paths.criteria', 'Repositories/Criteria'));
    }

}