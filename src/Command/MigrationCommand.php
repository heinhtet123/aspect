<?php 
namespace RoleCms\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

/**
* 
*/
class MigrationCommand extends Command
{
	
	 protected $name = 'aspect:migration';
	 protected $description = 'Creates a migration following the Aspect specifications.';


	  /**
     * Execute the custom console command.
     *
     * @var string
     */
	  public function fire()
	  {
	  	$this->laravel->view->addNamespace('aspect', substr(__DIR__, 0, -7).'views');

	  	$RolesTable="roles";
	  	$RolesPermissionTable="role_permissions";

	  	$this->info( "Tables: roles,role_permissions");

	  	
	  	$message = "A migration that creates roles, role_permissions"." tables will be created in database/migrations directory";

	  	$this->comment($message);
	  	$this->line('');


	  	if($this->confirm("Proceed with the migration creation? [Yes,No]","Yes"))
	  	{
	  		$this->line('');
	  		$this->info('Creating Migration....');



	  		if($this->createMigration("roles","role_permissions"))
	  		{
	  			$this->info("Migration successfully created!");
	  		}else
	  		{
	  			$this->error("Couldn't create migration.\n Check the write permissions".
                    " within the database/migrations directory.");
	  		}

	  	}
	  	$this->line('');

	  	// end of function
	  }

	  protected function createMigration($roles,$roles_permission){

	  	$migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_aspect_setup_tables.php";

	  	$data=compact("roles","roles_permission");
	  	$output=$this->laravel->view->make("aspect::generators.migration")->with($data)->render();


	  	 if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {

	  	 	fwrite($fs, $output);
            fclose($fs);
            return true;
	  	 }

	  	return false;
	  }
}