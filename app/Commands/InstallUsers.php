<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

/**
 * Description of InstallUsers
 *
 * @author alexey
 */
class InstallUsers extends BaseCommand {

    protected $group = 'AppInstall';
    protected $name = 'app_install:create_superadmin';
    protected $description = "Create superadmin user for extention";
    protected $usage = "app_install:create_superadmin [username] [email] [password]";
    protected $arguments = [
        'username' => "SuperAdmin username",
        'email' => "SuperAdmin email",
        'password' => "SuperAdmin password",
    ];

    public function run(array $params = []) {
        // create groups firs
        $groups = [
            'superadmin' => 'Application superadmin',
            'content_manager' => 'Content manager',
            'manager' => 'Sales manager',
            'sales_head' => 'Head of Sales Department',
            'owner' => 'Developer',
            'guests' => 'Front-end clients'
        ];

        $db = db_connect();
        $auth = service('authorization');

        foreach ($groups as $name => $description) {
            $find_group = $db->table('auth_groups')
                            ->select('*')
                            ->where('name', $name)
                            ->get()->getResultArray();
            if (!$find_group) {
                if ($auth->createGroup($name, $description)) {
                    CLI::write(CLI::color("Group {$name} created", 'yellow'));
                } else {
                    foreach ($auth->error() as $message) {
                        CLI::write($message, 'red');
                    }
                }
            } else {
                CLI::write(CLI::color("Group {$name} allready exist", 'yellow'));
            }
        }

        // crete super admin
        $row = [
            'active' => 1,
        ];

        $row['username'] = array_shift($params);
        if (empty($row['username'])) {
            $row['username'] = CLI::prompt('Username', null, 'required');
        }

        $row['email'] = array_shift($params);
        if (empty($row['email'])) {
            $row['email'] = CLI::prompt('Email', null, 'required');
        }

        $row['password'] = array_shift($params);
        if (empty($row['password'])) {
            $row['password'] = CLI::prompt('Password', null, 'required');
        }

        // Run the user through the entity and insert it
        $user = new User($row);

        $users = model(UserModel::class);
        if (($userId = $users->withGroup('superadmin')->insert($user))) {
            CLI::write(lang('Auth.registerCLI', [$row['username'], $userId]), 'green');
        } else {
            foreach ($users->errors() as $message) {
                CLI::write($message, 'red');
            }
        }
    }

}
