<?php echo "<?php" ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AspectSetupTables extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
    	 
       
    	Schema::create('{{ $roles }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('{{ $roles_permission }}', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->string('controller');
            $table->string('method');
            $table->boolean('status');
            $table->timestamps();
        });

         Schema::create('{{ $user }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('role_id');
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */

     public function down()
    {
        
    }

}