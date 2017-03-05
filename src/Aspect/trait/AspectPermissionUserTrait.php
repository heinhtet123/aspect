<?php 

namespace RoleCms\Aspect\trait;
use App\Models\Role; 
use App\Models\RolePermission;
use Illuminate\Support\Facades\Config;

trait AspectPermissionUserTrait
{


    public function role()
    {
        return $this->belongsTo(Config::get("aspect.role_model"),"role_id");
    }


    
    public function RoleHasPermission($current_url,$config){
        
            $methods=$config[$current_url["controller"]];
             $class=Config::get("aspect.role_permission_model");
             $rolepermission=new $class();
             

            $rolespermission=$rolespermission->where("controller",$current_url["controller"])->where("role_id",$this->role->id)->where("method",$current_url["method"])->where("status",1)->get();


            if(in_array($current_url["method"], $methods) && !$rolespermission->isEmpty())
            {
             
                return true;
            }

            return false;
    }


    /**
     * Checks if the user has a role by its name.
     *
     * @param bool         $requireAll All roles in the array are required.
     *
     * @return bool
     */

    public function hasRole($requireAll = false)
    {
        $class=Config::get("aspect.role_model");
        $role_model=new $class();
       
        $roles=$role_model->all();
        foreach ($roles as $role) {
            # code...
            if($this->role->name==$role->name){
                return true;
            }
        }

        return false;
        //return $this->role->name;
    }
	
}