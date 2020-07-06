server 'admin.staging.rem.work',
user: 'rem_work_staging',
roles: %w{web app},
port:22

# Directory to deploy
# ===================
set :env, 'staging'
set :app_debug, 'false'
set :deploy_to, '/home/rem_work_staging/admin'
set :shared_path, '/home/rem_work_staging/admin/shared'
set :overlay_path, '/home/rem_work_staging/admin/overlay'
set :tmp_dir, '/home/rem_work_staging/admin/tmp'
set :site_url, 'https://admin.staging.rem.work'
set :php_fpm, 'php7.2-fpm'
set :supervisor_task, 'laravel-rem_work_staging-worker'

set :nvm_type, :user # or :system, depends on your nvm setup
set :nvm_node, 'v12.18.1'
set :nvm_map_bins, %w{node npm yarn}
