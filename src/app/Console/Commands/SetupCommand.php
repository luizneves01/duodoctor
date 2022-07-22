<?php

namespace Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Command;
use Facades\RolesFacades;
use Models\Role;
use Models\RoleGroup;
use Models\RolePermission;
use Models\Permission;
use Models\ProfilePermission;

class SetupCommand extends Command
{

    protected $created = 0;
    protected $attemps = 0;
    protected $roles = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roleduodoctor:setup {service?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consulta rotas do sistema e cadastra as mesmas no padrão duodoctor';

    public function __construct(RolesFacades $facades)
    {
        parent::__construct();
        $this->roles = $facades->getRoles();
    }

    public function handle()
    {

        $service = $this->argument('service') ?? "";

        $routes = Route::getRoutes();

        foreach ($routes as $route) {

            $this->attemps++;

            $role_instructions = collect($this->roles)->where('code', $route['action']['code'] ?? 'undefined')->first();

            $method = $route['method'] ?? "GET";
            $code = $role_instructions->code ?? "undefined";
            $name = $route['action']['as'] ?? "undefined";
            $nameRole = $role_instructions->name ?? "undefined";
            $nameRoleGroup = $role_instructions->group ?? "undefined";            
            $route = $route['uri'] ?? "/";

            $this->createRoute($method, $route, $code, $name, $nameRole, $nameRoleGroup, $service);
        }

        Log::info("Tentivas: " . $this->attemps);
        Log::info("Criadas/Atualizadas: " . $this->created);
        $this->info("Tentivas: " . $this->attemps);
        $this->info("Criadas/Atualizadas: " . $this->created);
    }

    private function createRoute($method, $route, $code, $name, $nameRole, $nameRoleGroup, $service)
    {
        DB::beginTransaction();

        Log::info("createRoute");

        try {

            $roleGroup = RoleGroup::firstOrCreate([
                'name' => $nameRoleGroup
            ]);

            Log::info("roleGroup " . $roleGroup->id);

            $role = Role::firstOrCreate([
                'name' => $nameRole,
                'code' => $code,
                'role_group_id' => $roleGroup->id
            ]);

            Log::info("role " . $role->id);

            $permission = Permission::firstOrCreate([
                'code' => $code,
                'name' => $name,
                'route' => $method . "->" . $service . $route
            ]);

            Log::info("permission_id: " . $permission->id . " permission_route: " . $permission->route);
            $this->info("permission_id: " . $permission->id . " permission_route: " . $permission->route);

            $rolePermission = RolePermission::firstOrCreate([
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]);

            Log::info("rolePermission " . $rolePermission->id);

            DB::commit();

            $this->created++;

            Log::info("commit");
        } catch (\Exception $e) {

            DB::rollBack();
            Log::info("rollBack");
        }
    }
}
