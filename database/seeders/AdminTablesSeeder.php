<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "Dashboard",
                    "icon" => "fa-bar-chart",
                    "uri" => "/",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 18,
                    "title" => "Admin",
                    "icon" => "fa-tasks",
                    "uri" => "",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 19,
                    "title" => "Users",
                    "icon" => "fa-users",
                    "uri" => "auth/users",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 20,
                    "title" => "Roles",
                    "icon" => "fa-user",
                    "uri" => "auth/roles",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 21,
                    "title" => "Permission",
                    "icon" => "fa-ban",
                    "uri" => "auth/permissions",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 22,
                    "title" => "Menu",
                    "icon" => "fa-bars",
                    "uri" => "auth/menu",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 23,
                    "title" => "Operation log",
                    "icon" => "fa-history",
                    "uri" => "auth/logs",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "Travaux",
                    "icon" => "fa-briefcase",
                    "uri" => NULL,
                    "permission" => NULL
                ],
                [
                    "parent_id" => 8,
                    "order" => 3,
                    "title" => "Tableaux",
                    "icon" => "fa-paint-brush",
                    "uri" => "works/paintings",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 8,
                    "order" => 4,
                    "title" => "Sculptures",
                    "icon" => "fa-binoculars",
                    "uri" => "works/sculptures",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 8,
                    "order" => 5,
                    "title" => "Lithographies",
                    "icon" => "fa-pencil",
                    "uri" => "works/lithographies",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 14,
                    "order" => 8,
                    "title" => "Demandes  en attente",
                    "icon" => "fa-calendar-plus-o",
                    "uri" => "demands?&statut=En+attente",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 8,
                    "order" => 6,
                    "title" => "Faux œuvres",
                    "icon" => "fa-odnoklassniki-square",
                    "uri" => "demands?&statut=Refusée",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 7,
                    "title" => "Demandes de certificat",
                    "icon" => "fa-bookmark",
                    "uri" => NULL,
                    "permission" => NULL
                ],
                [
                    "parent_id" => 14,
                    "order" => 9,
                    "title" => "Demandes traitées",
                    "icon" => "fa-bars",
                    "uri" => "demands?&statut=Acceptée",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 15,
                    "title" => "Recherches par code",
                    "icon" => "fa-search",
                    "uri" => "recherches",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 14,
                    "title" => "Certificats",
                    "icon" => "fa-check",
                    "uri" => "certificats",
                    "permission" => "artiste"
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Media",
                    "icon" => "fa-medium",
                    "uri" => "media",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 21,
                    "order" => 0,
                    "title" => "Tableaux",
                    "icon" => "fa-paint-brush",
                    "uri" => "media/tableaux",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 21,
                    "order" => 0,
                    "title" => "Sculpture",
                    "icon" => "fa-binoculars",
                    "uri" => "media/sculptures",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 21,
                    "order" => 0,
                    "title" => "lithographies",
                    "icon" => "fa-pencil",
                    "uri" => "media/lithographies",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 18,
                    "order" => 11,
                    "title" => "Tableau",
                    "icon" => "fa-paint-brush",
                    "uri" => "media/tableaux",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 18,
                    "order" => 12,
                    "title" => "Sculptures",
                    "icon" => "fa-binoculars",
                    "uri" => "media/sculptures",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 18,
                    "order" => 13,
                    "title" => "Litographie",
                    "icon" => "fa-pencil",
                    "uri" => "media/lithographies",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 16,
                    "title" => "Abonnements",
                    "icon" => "fa-money",
                    "uri" => "/abonnements",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 17,
                    "title" => "Messages",
                    "icon" => "fa-envelope",
                    "uri" => "/messages",
                    "permission" => NULL
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "name" => "All permission",
                    "slug" => "*",
                    "http_method" => "",
                    "http_path" => "*"
                ],
                [
                    "name" => "Dashboard",
                    "slug" => "dashboard",
                    "http_method" => "GET",
                    "http_path" => "/"
                ],
                [
                    "name" => "Login",
                    "slug" => "auth.login",
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout"
                ],
                [
                    "name" => "User setting",
                    "slug" => "auth.setting",
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting"
                ],
                [
                    "name" => "Auth management",
                    "slug" => "auth.management",
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs"
                ],
                [
                    "name" => "Artiste",
                    "slug" => "artiste",
                    "http_method" => "GET,POST,PUT",
                    "http_path" => "/works*\r\n/demands*\r\n/recherches*\r\n/certificats*\r\n/media*\r\n/*/abonnement"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "Administrateur",
                    "slug" => "administrateur"
                ],
                [
                    "name" => "Artiste",
                    "slug" => "artiste"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 2
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 14
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 15
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 19
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 20
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 25
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 26
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 8
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 9
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 10
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 11
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 14
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 15
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 16
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 19
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 20
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 22
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 23
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 24
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 1,
                    "permission_id" => 1
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 2
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 3
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 4
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 6
                ]
            ]
        );

        // finish
    }
}
