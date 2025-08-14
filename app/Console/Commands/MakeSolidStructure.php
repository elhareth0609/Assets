<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeSolidStructure extends Command {
    protected $signature = 'make:solid {name}';
    protected $description = 'Generate full structure for a Client-like module';

    public function handle() {
        $name = Str::studly($this->argument('name')); // Example: Client
        $lowerName = Str::lower($name);
        $pluralLower = Str::plural($lowerName);

        // Generate model with migration
        $this->call('make:model', ['name' => $name, '--migration' => true]);

        // Generate controller
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        File::put($controllerPath, $this->getControllerContent($name));

        // Generate resource
        $resourcePath = app_path("Http/Resources/{$name}/{$name}Resource.php");
        File::ensureDirectoryExists(dirname($resourcePath));
        File::put($resourcePath, $this->getResourceContent($name));

        // Generate request
        $requestPath = app_path("Http/Requests/{$name}/{$name}Request.php");
        File::ensureDirectoryExists(dirname($requestPath));
        File::put($requestPath, $this->getRequestContent($name));

        // Generate interface
        $interfacePath = app_path("Interfaces/{$name}RepositoryInterface.php");
        File::put($interfacePath, $this->getInterfaceContent($name));

        // Generate repository
        $repositoryPath = app_path("Repositories/{$name}Repository.php");
        File::put($repositoryPath, $this->getRepositoryContent($name));

        // Generate service
        $servicePath = app_path("Services/{$name}Service.php");
        File::put($servicePath, $this->getServiceContent($name));

        $this->info("All files for {$name} have been created. Please add binding in RepositoryServiceProvider.");
    }

    protected function getControllerContent($name) {
        return <<<PHP
<?php

namespace App\Http\Controllers;

use App\Http\Requests\\{$name}\\{$name}Request;
use App\Http\Resources\\{$name}\\{$name}Resource;
use App\Services\\{$name}Service;
use App\Traits\ApiResponder;

class {$name}Controller extends Controller {
    use ApiResponder;

    private \${$name}Service;

    public function __construct({$name}Service \${$name}Service) {
        \$this->{$name}Service = \${$name}Service;
    }

    public function all() {
        return \$this->success({$name}Resource::collection(\$this->{$name}Service->all{$name}s()));
    }

    public function get(\$id) {
        return \$this->success(new {$name}Resource(\$this->{$name}Service->get{$name}(\$id)));
    }

    public function create({$name}Request \$request) {
        return \$this->success(new {$name}Resource(\$this->{$name}Service->create{$name}(\$request->validated())), __('Created Successfully.'));
    }

    public function update({$name}Request \$request, \$id) {
        return \$this->success(new {$name}Resource(\$this->{$name}Service->update{$name}(\$id, \$request->validated())), __('Updated Successfully.'));
    }

    public function delete(\$id) {
        \$this->{$name}Service->delete{$name}(\$id);
        return \$this->success(null, __('Deleted Successfully.'));
    }
}
PHP;
    }

    protected function getResourceContent($name) {
        return <<<PHP
<?php

namespace App\Http\Resources\\{$name};

use Illuminate\Http\Resources\Json\JsonResource;

class {$name}Resource extends JsonResource {
    public function toArray(\$request) {
        return [
            'id' => \$this->id,
            'name' => \$this->name,
            'status' => \$this->status
        ];
    }
}
PHP;
    }

    protected function getRequestContent($name) {
        return <<<PHP
<?php

namespace App\Http\Requests\\{$name};

use Illuminate\Foundation\Http\FormRequest;

class {$name}Request extends FormRequest {
    public function rules() {
        return [
            'name' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
PHP;
    }

    protected function getInterfaceContent($name) {
        return <<<PHP
<?php

namespace App\Interfaces;

interface {$name}RepositoryInterface {
    public function find(\$id);
    public function create(array \$data);
    public function update(\$id, array \$data);
    public function delete(\$id);
    public function actived();
    public function all();
}
PHP;
    }

    protected function getRepositoryContent($name) {
        return <<<PHP
<?php

namespace App\Repositories;

use App\Interfaces\\{$name}RepositoryInterface;
use App\Models\\{$name};

class {$name}Repository implements {$name}RepositoryInterface {
    private \${$name};

    public function __construct({$name} \${$name}) {
        \$this->{$name} = \${$name};
    }

    public function find(\$id) {
        return \$this->{$name}->findOrFail(\$id);
    }

    public function create(array \$data) {
        return \$this->{$name}->create(\$data);
    }

    public function update(\$id, array \$data) {
        \$model = \$this->find(\$id);
        \$model->update(\$data);
        return \$model;
    }

    public function delete(\$id) {
        return \$this->find(\$id)->delete();
    }

    public function all() {
        return \$this->{$name}->all();
    }

    public function actived() {
        return \$this->{$name}->where('status', 'active')->get();
    }
}
PHP;
    }

    protected function getServiceContent($name) {
        return <<<PHP
<?php

namespace App\Services;

use App\Interfaces\\{$name}RepositoryInterface;

class {$name}Service {
    private \${$name}Repository;

    public function __construct({$name}RepositoryInterface \${$name}Repository) {
        \$this->{$name}Repository = \${$name}Repository;
    }

    public function get{$name}(\$id) {
        return \$this->{$name}Repository->find(\$id);
    }

    public function all{$name}s() {
        return \$this->{$name}Repository->all();
    }

    public function actived{$name}s() {
        return \$this->{$name}Repository->actived();
    }

    public function create{$name}(array \$data) {
        return \$this->{$name}Repository->create(\$data);
    }

    public function update{$name}(\$id, array \$data) {
        return \$this->{$name}Repository->update(\$id, \$data);
    }

    public function delete{$name}(\$id) {
        return \$this->{$name}Repository->delete(\$id);
    }
}
PHP;
    }
}
