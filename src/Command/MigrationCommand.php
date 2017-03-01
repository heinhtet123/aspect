<?php 
namespace RoleCms\Command;

use Illuminate\Console\Command;
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
	  	 $this->line('helloworld hi there this is Aspect');
	  }

}