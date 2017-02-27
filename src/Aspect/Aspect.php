<?php 

namespace RoleCms\Aspect;
use Illuminate\Support\Facades\Config;
use App\Models\RolePermission;
/**
* 
*/
class Aspect
{
	public $app;
	
	function __construct($app)
	{
		$this->app=$app;
	}

	 public function user()
    {
       return $this->app->auth->user();
       
    }

    public function RoleHaspermission()
    {
    	if($user=$this->user())
    	{
    		$config_permission=Config::get("rolespermission");
    		$url=\Request::route()->getName();

    		//dd(\Route::getCurrentRoute()->getActionName());
		

			if(strpos($url,".")!=false)
			{
				$arr=explode(".", $url);
				$currenturl["controller"]=$arr[count($arr)-2];
				$currenturl["method"]=$arr[count($arr)-1];
				
				$rolename=$this->user()->role->name;

				
				// dd($config_permission);
				
				return $this->user()->RoleHaspermission($currenturl,$config_permission);

			}else
			{

			}



    		
    		
    	}

    	 
    	
       
    }
    
    public function hasRole($requireAll=false)
    {

    	if($user=$this->user())
    	{
    	  return $user->hasRole($requireAll);
    	}

    	return false;
    }
    
}