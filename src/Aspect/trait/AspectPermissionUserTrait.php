<?php 

namespace RoleCms\Aspect\trait;
use App\Models\Role; 
use App\Models\RolePermission;
trait AspectPermissionUserTrait
{


    

    public function RoleHasPermission($current_url,$config){
        
            $methods=$config[$current_url["controller"]];

            $rolespermission=RolePermission::where("controller",$current_url["controller"])->where("role_id",$this->role->id)->where("method",$current_url["method"])->where("status",1)->get();


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
       
        $roles=Role::all();
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