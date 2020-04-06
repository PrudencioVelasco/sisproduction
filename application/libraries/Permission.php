<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission
{
    private static $_CI;

    public function __construct()
    {
        self::$_CI =& get_instance();
        self::$_CI->load->database();
    }

    public static function grant($uri)
    {
        $match = false;
        $user_id = $_SESSION['user_id'];
        $permissions = self::$_CI->db
                      ->select('tblpermiso.uri')
                      ->from('permissions as tblpermiso')
                      ->join('permission_rol as tblpermisorol', 'tblpermiso.id = tblpermisorol.permission_id')
                      ->join('rol as tblrol', 'tblpermisorol.rol_id = tblrol.id')
                      ->join('users_rol as tblrolusuario', 'tblrol.id= tblrolusuario.id_rol')
                      ->join('users as tblusuario', 'tblrolusuario.id_user= tblusuario.id')
                      ->where('tblusuario.id', $user_id)
                      ->get()
                      ->result();

        foreach($permissions as $permission) {
            if(strtolower($permission->uri) != "*") {
                $re_uri = preg_replace('/\\\\\*/','*', preg_quote(strtolower($permission->uri), '/'));
                $match = preg_match("/{$re_uri}/", strtolower($uri));
            }

            if(strtolower($permission->uri) == "*" || strtolower($uri) == 'admin/index') {
                return;
            } else {
                $match = (!$match) ? $match : true;
            }

            // if found true
            if($match) {
                return;
            }
        }

        // if all false
        if(!$match) {
            self::$_CI->session->set_flashdata('err', 'You don\'t have permissionss.');
            return redirect('Admin/');

        }
    }

    public function __destruct()
    {
        self::$_CI->db->close();
    }
}
?>
