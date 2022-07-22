<?php

namespace Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Models\Permission;
use Models\ProfilePermission;

class ProprietarioCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roleduodoctor:proprietario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aplica todas as permissions no profile "Proprietário"';

    public function handle()
    {
        try {
            $permissions = Permission::all();
    
            DB::beginTransAction();

            foreach($permissions as $permission) {
                $profilePermission = ProfilePermission::firstOrCreate([
                    'permission_id' => $permission->id,
                    'profile_id' => 1
                ]);
            }

            DB::commit();

            $this->info("Total de permissions encontradas: " . $permissions->count());
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $this->error($e->getMessage());
        }
    }
}
