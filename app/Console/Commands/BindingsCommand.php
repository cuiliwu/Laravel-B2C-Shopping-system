<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Prettus\Repository\Generators\FileAlreadyExistsException;
use Prettus\Repository\Generators\RepositoryEloquentGenerator;
use Prettus\Repository\Generators\RepositoryInterfaceGenerator;

class BindingsCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    //protected $name = 'make:repo';

    protected $signature = 'make:repo {name}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Add repository bindings to service provider.';

    /**
     * The placeholder for repository bindings
     *
     * @var string
     */
    public $bindPlaceholder = '//:end-bindings:';

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'bindings/bindings';

    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle(){
        $this->name = $this->argument('name');
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $this->call('make:repository', [
            'name' => $this->name
        ]);
        try {
            // Add entity repository binding to the repository service provider
            $provider = File::get($this->getPath());
            $repositoryInterface = '\\' . $this->getRepository() . "::class";
            $repositoryEloquent = '\\' . $this->getEloquentRepository() . "::class";
            //var_dump();exit;
            File::put($this->getPath(), str_replace($this->bindPlaceholder, "\$this->app->bind({$repositoryInterface}, $repositoryEloquent);" . PHP_EOL . '        ' . $this->bindPlaceholder, $provider));
            $this->info('绑定成功');
        } catch (FileAlreadyExistsException $e) {
            $this->error('绑定创建失败');
        }
    }

    public function getPath()
    {
        return app()->path() . '/Providers/RepositoryServiceProvider.php';
    }

    public function getRepository()
    {
        $repositoryGenerator = new RepositoryInterfaceGenerator([
            'name' => $this->name,
        ]);

        $repository = $repositoryGenerator->getRootNamespace() . '\\' . $repositoryGenerator->getName();

        return str_replace([
                "\\",
                '/'
            ], '\\', $repository) . 'Repository';
    }

    /**
     * Gets eloquent repository full class name
     *
     * @return string
     */
    public function getEloquentRepository()
    {
        $repositoryGenerator = new RepositoryEloquentGenerator([
            'name' => $this->name,
        ]);

        $repository = $repositoryGenerator->getRootNamespace() . '\\' . $repositoryGenerator->getName();

        return str_replace([
                "\\",
                '/'
            ], '\\', $repository) . 'RepositoryEloquent';
    }
}
