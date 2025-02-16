<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';

// Config

set('repository', 'git@gitlab.n2rtechnologies.com:rc21292/shl.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'npm:install',
    'npm:run:prod',
    'deploy:publish',
]);

task('npm:run:prod', function () {
    cd('{{release_or_current_path}}');
    run('composer install');
    run('npm run build');
});

host('staging')
    ->set('hostname', '3.1.178.60')
    ->set('branch', 'main')
    ->set('remote_user', 'ubuntu')
    ->set('deploy_path', '/var/www/html');
    
host('production')
    ->set('hostname', '18.139.151.254')
    ->set('branch', 'main')
    ->set('remote_user', 'ubuntu')
    ->set('deploy_path', '/var/www/html');

// Hooks

after('deploy:failed', 'deploy:unlock');
