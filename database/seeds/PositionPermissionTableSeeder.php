<?php

use EBuildingDiary\Permission;
use Illuminate\Database\Seeder;
use EBuildingDiary\Position;

class PositionPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Positions
        $worker_position = new Position();
        $worker_position->name = 'worker';
        $worker_position->display_name = 'Tavatöötaja';
        $worker_position->description = 'Allub töödejuhatajale';
        $worker_position->save();

        $foreman_position = new Position();
        $foreman_position->name = 'foreman';
        $foreman_position->display_name = 'Töödejuhataja';
        $foreman_position->description = 'Juhib tavatöötajaid';
        $foreman_position->save();

        $boss_position = new Position();
        $boss_position->name = 'boss';
        $boss_position->display_name = 'Ülemus';
        $boss_position->description = 'Firma juht';
        $boss_position->save();

        $technician_position = new Position();
        $technician_position->name = 'technician';
        $technician_position->display_name = 'Tehnik';
        $technician_position->description = 'Dokumentide haldur';
        $technician_position->save();

        //Events permissions
        $controller = 'events';

        $view_events_permission = new Permission();
        $view_events_permission->name = 'view-events';
        $view_events_permission->display_name = 'Sündmuste ülevaade';
        $view_events_permission->description = 'Luba ülevaadata sündmusi';
        $view_events_permission->controller = $controller;
        $view_events_permission->save();

        $manage_events_permission = new Permission();
        $manage_events_permission->name = 'manage-events';
        $manage_events_permission->display_name = 'Sündmuste haldamine';
        $manage_events_permission->description = 'Luba hallata sündmusi';
        $manage_events_permission->controller = $controller;
        $manage_events_permission->save();

        //Documents permissions
        $controller = 'documents';

        $store_diary_permission = new Permission();
        $store_diary_permission->name = 'store-diary';
        $store_diary_permission->display_name = 'Ehituspäeviku täitmine';
        $store_diary_permission->description = 'Luba esitada päeviku';
        $store_diary_permission->controller = $controller;
        $store_diary_permission->save();

        $view_diaries_permission = new Permission();
        $view_diaries_permission->name = 'view-diaries';
        $view_diaries_permission->display_name = 'Päevikute ülevaade';
        $view_diaries_permission->description = 'Luba ülevaadata päevikuid';
        $view_diaries_permission->controller = $controller;
        $view_diaries_permission->save();

        $manage_diaries_permission = new Permission();
        $manage_diaries_permission->name = 'manage-diaries';
        $manage_diaries_permission->display_name = 'Ehituspäevikute haldamine';
        $manage_diaries_permission->description = 'Luba hallata ehituspäevikuid';
        $manage_diaries_permission->controller = $controller;
        $manage_diaries_permission->save();

        $view_acts_permission = new Permission();
        $view_acts_permission->name = 'view-acts';
        $view_acts_permission->display_name = 'Kaetud töö aktide ülevaade';
        $view_acts_permission->description = 'Luba ülevaadata kaetud töö akte';
        $view_acts_permission->controller = $controller;
        $view_acts_permission->save();

        $view_protocols_permission = new Permission();
        $view_protocols_permission->name = 'view-protocols';
        $view_protocols_permission->display_name = 'Töökoosoleku protokollide ülevaade';
        $view_protocols_permission->description = 'Luba ülevaadata töökoosoleku protokolle';
        $view_protocols_permission->controller = $controller;
        $view_protocols_permission->save();

        //Employees permissions
        $controller = 'employees';

        $view_employees_permission = new Permission();
        $view_employees_permission->name = 'view-employees';
        $view_employees_permission->display_name = 'Töötajate ülevaade';
        $view_employees_permission->description = 'Luba ülevaadata töötajaid';
        $view_employees_permission->controller = $controller;
        $view_employees_permission->save();

        $manage_employees_permission = new Permission();
        $manage_employees_permission->name = 'manage-employees';
        $manage_employees_permission->display_name = 'Töötajate haldamine';
        $manage_employees_permission->description = 'Luba hallata töötajaid';
        $manage_employees_permission->controller = $controller;
        $manage_employees_permission->save();

        $manage_worker_permission = new Permission();
        $manage_worker_permission->name = 'manage-worker';
        $manage_worker_permission->display_name = 'Tavatöötaja haldamine';
        $manage_worker_permission->description = 'Luba hallata tavatöötajat';
        $manage_worker_permission->controller = $controller;
        $manage_worker_permission->save();

        $manage_foreman_permission = new Permission();
        $manage_foreman_permission->name = 'manage-foreman';
        $manage_foreman_permission->display_name = 'Töödejuhatajate haldamine';
        $manage_foreman_permission->description = 'Luba hallata töödejuhatajaid';
        $manage_foreman_permission->controller = $controller;
        $manage_foreman_permission->save();

        $manage_boss_permission = new Permission();
        $manage_boss_permission->name = 'manage-boss';
        $manage_boss_permission->display_name = 'Ülemite haldamine';
        $manage_boss_permission->description = 'Luba hallata ülemeid';
        $manage_boss_permission->controller = $controller;
        $manage_boss_permission->save();

        //Positions permissions
        $controller = 'positions';

        $view_positions_permission = new Permission();
        $view_positions_permission->name = 'view-positions';
        $view_positions_permission->display_name = 'Positsioonide ülevaade';
        $view_positions_permission->description = 'Luba ülevaadata positsioone';
        $view_positions_permission->controller = $controller;
        $view_positions_permission->save();

        $manage_positions_permission = new Permission();
        $manage_positions_permission->name = 'manage-positions';
        $manage_positions_permission->display_name = 'Positsioonide haldamine';
        $manage_positions_permission->description = 'Luba hallata positioone';
        $manage_positions_permission->controller = $controller;
        $manage_positions_permission->save();

        //Object permissions
        $controller = 'projects';

        $view_projects_permission = new Permission();
        $view_projects_permission->name = 'view-projects';
        $view_projects_permission->display_name = 'Objektide ülevaade';
        $view_projects_permission->description = 'Luba ülevaadata objekte';
        $view_projects_permission->controller = $controller;
        $view_projects_permission->save();

        $manage_projects_permission = new Permission();
        $manage_projects_permission->name = 'manage-projects';
        $manage_projects_permission->display_name = 'Objektide haldamine';
        $manage_projects_permission->description = 'Luba hallata objekte';
        $manage_projects_permission->controller = $controller;
        $manage_projects_permission->save();

        //Accounting permissions
        $controller = 'accounting';

        $view_accounting_permission = new Permission();
        $view_accounting_permission->name = 'view-accounting';
        $view_accounting_permission->display_name = 'Raamatupidamise ülevaade';
        $view_accounting_permission->description = 'Luba ülevaadata raamatupidamist';
        $view_accounting_permission->controller = $controller;
        $view_accounting_permission->save();

        $manage_accounting_permission = new Permission();
        $manage_accounting_permission->name = 'manage-accounting';
        $manage_accounting_permission->display_name = 'Raamatupidamise haldamine';
        $manage_accounting_permission->description = 'Luba hallata raamatupidamist';
        $manage_accounting_permission->controller = $controller;
        $manage_accounting_permission->save();

        //Attendances permissions
        $controller = 'attendances';

        $view_attendances_permission = new Permission();
        $view_attendances_permission->name = 'view-attendances';
        $view_attendances_permission->display_name = 'Kohaloleku ülevaade';
        $view_attendances_permission->description = 'Luba ülevaadata kohalolekut';
        $view_attendances_permission->controller = $controller;
        $view_attendances_permission->save();

        //Settings permissions
        $controller = 'settings';
        $manage_settings_permission = new Permission();
        $manage_settings_permission->name = 'manage-settings';
        $manage_settings_permission->display_name = 'Seadete haldamine';
        $manage_settings_permission->description = 'Luba hallata seadeid';
        $manage_settings_permission->controller = $controller;
        $manage_settings_permission->save();

        //Assign permissions to positions
        $worker_position->attachPermissions([
            $view_events_permission,
            $store_diary_permission
        ]);

        $foreman_position->attachPermissions(
            [
                $view_events_permission,
                $manage_events_permission,
                $view_accounting_permission,
                $store_diary_permission,
                $view_diaries_permission,
                $manage_diaries_permission,
                $view_acts_permission,
                $view_protocols_permission,
                $view_employees_permission,
                $manage_employees_permission,
                $manage_worker_permission,
                $view_projects_permission,
                $manage_projects_permission,
                $view_attendances_permission
            ]);

        $boss_position->attachPermissions(
            [
                $view_events_permission,
                $manage_events_permission,
                $view_accounting_permission,
                $store_diary_permission,
                $view_diaries_permission,
                $manage_diaries_permission,
                $view_acts_permission,
                $view_protocols_permission,
                $view_employees_permission,
                $manage_employees_permission,
                $manage_worker_permission,
                $manage_foreman_permission,
                $manage_boss_permission,
                $view_positions_permission,
                $manage_positions_permission,
                $view_projects_permission,
                $manage_projects_permission,
                $manage_settings_permission,
                $view_attendances_permission,
                $manage_accounting_permission
            ]);

        $technician_position->attachPermissions(
            [
                $store_diary_permission,
                $view_diaries_permission,
                $manage_diaries_permission
            ]);
    }
}
