<?php
namespace Limber\Database\Migration;

use Limber\Console\ConsoleInterface;
use Limber\Console\Output;

class Console implements ConsoleInterface
{
    public function help(): string
    {
        return 'Handles database migrations.';
    }

    public function execute(string $task = '', array $arguments = []): string
    {
        // Run the right task.
        switch ($task) {
            case 'create':
                return $this->create($arguments);
            case 'install':
                return $this->install($arguments);
            case 'reset':
                return $this->reset($arguments);
            case 'rollback':
                return $this->rollback($arguments);
            default:
                return $this->run($arguments);
        }
        return '';
    }

    public function run(array $arguments = []): string
    {
        // Get the uninstalled modules.
        $migrations = Model::where('installed', '=', '0')->orderBy('created_at', 'desc')->all();
        // Run the migrations.
        foreach ($migrations as $migration)
        {
            // Get the class name.
            $name = substr($migration->migration, 0, -4);
            $name = sprintf('\\modules\\%s\\Migration\\%s', $migration->module, $name);
            // If migration exists, run it.
            if (is_file(path('modules', $migration->module) . 'Migration/' . $migration->migration)) {
                // Instantiate the migration.
                $class = new $name;
                // Does the up method exist?
                if (method_exists($class, 'up')) {
                    // Run the migrations up method.
                    $class->up();
                    // Record the migration as installed.
                    $migration->installed = 1;
                    $migration->save();
                    // Send output.
                    Output::send(sprintf('%s-%s Installed.', $migration->module, $migration->migration));
                }
            }
        }
        return 'Migrations installed';
    }

    public function reset(array $arguments = []): string
    {
        return '';
    }

    public function rollback(array $arguments = []): string
    {
        return '';
    }

    public function install(array $arguments = []): string
    {
        Schema::create('migrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module');
            $table->string('migration');
            $table->boolean('installed');
            $table->datetime('created_at');
        });
        return 'Installed migrations.';
    }

    public function create(array $arguments = []): string
    {
        // Get the arguments.
        list($module, $migration) = $arguments;
        // Check if the module exists.
        if (is_dir($path = path('modules', $module))) {
            // Ensure the 'Migration' folder exists within the module directory.
            if (!is_dir($directory = $path . 'Migration')) {
                if (!mkdir($directory)) {
                    return 'Unable to create module migration folder.';
                }
            }

            // Get the current date to suffix the class with.
            $time   = time();
            $suffix = '_' . date('YmdHis', $time);

            // Create the migration file contents.
            $contents = $this->blank($suffix, $module, $migration);

            // Set the file name.
            $file = $migration . $suffix . '.php';

            // Write the file.
            $fp = fopen($directory . '/' . $file, 'wb');
            fwrite($fp, $contents);
            fclose($fp);

            // Create a new migration record.
            $model              = new Model;
            $model->module      = $module;
            $model->migration   = $file;
            $model->created_at  = date('Y-m-d H:i:s', $time);
            $model->save();

            // Return message.
            return sprintf('Successfully created new migration %s.', $file);
        } else {
            return 'Failed to create migration, module does not exist.';
        }
    }

    private function blank($suffix, $module, $migration): string
    {
        $contents = "<?php\n";
        $contents .= "namespace modules\\$module\Migration;\n\n";
        $contents .= "use \Limber\Database\Migration\Blueprint;\n";
        $contents .= "use \Limber\Database\Migration\Migration;\n";
        $contents .= "use \Limber\Database\Migration\Schema;\n\n";
        $contents .= "class $migration$suffix extends Migration\n";
        $contents .= "{\n\n";
        $contents .= "\t/**\n";
        $contents .= "\t * Install the migration.\n";
        $contents .= "\t * \n";
        $contents .= "\t * @return void\n";
        $contents .= "\t */\n";
        $contents .= "\tpublic function up()\n";
        $contents .= "\t{\n\t\t\n";
        $contents .= "\t}\n\n";
        $contents .= "\t/**\n";
        $contents .= "\t * Rollback the migration.\n";
        $contents .= "\t * \n";
        $contents .= "\t * @return void\n";
        $contents .= "\t */\n";
        $contents .= "\tpublic function down()\n";
        $contents .= "\t{\n\t\t\n";
        $contents .= "\t}\n\n";
        $contents .= "}\n";

        return $contents;
    }
}